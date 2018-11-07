<?php

App::uses('AppModel', 'Model');
App::uses('AttachmentBehavior', 'Uploader.Model/Behavior');

/**
 * Announcement Model
 *
 * @property Classroom $Classroom
 * @property User $User
 */
class Announcement extends AppModel {

    /**
     * pagination limit for announcements
     */
    const PAGINATION_LIMIT = 15;

//    public function beforeUpload($options) {
//
//        $options['transport']['accessKey'] = getenv('S3_ACCESS_KEY');
//        $options['transport']['secretKey'] = getenv('S3_SECRET_KEY');
//        $options['transport']['bucket'] = getenv('S3_BUCKET');
//
//        return $options;
//    }

    public $actsAs = array(
        'Uploader.Attachment' => array(
            'file_path' => array(
                'overwrite' => true,
                'transport' => array(
                    'class' => AttachmentBehavior::S3,
                    'region' => Aws\Common\Enum\Region::SINGAPORE,
//                    'folder' => 'announcements/',
                    'accessKey' => 'AKIAJSFESXV3YYXGWI4Q',
                    'secretKey' => '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',
                    'bucket' => 'pyoopil-files',
                    //Dynamically add 'accesskey','secretKey','bucket'
                ),
                'metaColumns' => array(
//                  'ext' => 'extension',
//                  'type' => 'mimeType',
                    'size' => 'filesize',
                    'name' => 'filename'
//                  'exif.model' => 'camera'
                )
            )
        ),
//        'Uploader.FileValidation' => array(
//            'file_path' => array(
////                'type' => 'image',
////                'mimeType' => array('image/gif'),
//                'filesize' => 2097152,
//                'required' => false
//            )
//        )
    );

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'Classroom' => array(
            'className' => 'Classroom',
            'foreignKey' => 'classroom_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'AppUser' => array(
            'className' => 'AppUser',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),

    );

    /**
     * Get announcement by ID
     * @param int $announcementId
     * @return array
     */
    public function getAnnouncementById($announcementId) {
        $params = array(
            'contain' => array(
                'AppUser' => array(
                    'fields' => array('fname', 'lname')
                )
            ),
            'conditions' => array(
                'Announcement.id' => $announcementId
            )
        );

        return $this->find('first', $params);
    }

    /**
     * Retrieve paginated announcements
     * @param int $classroomId
     * @param int $page
     * @param bool $onlylatest
     * @return array
     */
    public function getPaginatedAnnouncements($classroomId, $page = 1, $onlylatest = false) {

        //sanity check
        if ($page < 1) {
            $page = 1;
        }

        $offset = self::PAGINATION_LIMIT * ($page - 1);

        $options = array(
            'contain' => array(
                'AppUser' => array(
                    'fields' => array('fname', 'lname')
                )
            ),
            'conditions' => array(
                'classroom_id' => $classroomId
            ),
            'limit' => self::PAGINATION_LIMIT,
            'offset' => $offset,
            'order' => array(
                'Announcement.created' => 'desc'
            )
        );

        if ($onlylatest) {
            $options['limit'] = 1;
            unset($options['offset']);
        }

        $data = $this->find('all', $options);
        return $data;
    }

    /**
     * Creates a new announcement
     * @param $userId
     * @param $classroomId
     * @param $data
     * @return bool
     */
    public function createAnnouncement($classroomId, $data, $userId) {

        $data['Announcement']['classroom_id'] = $classroomId;
        $data['Announcement']['user_id'] = $userId;

        if ($this->save($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Dispatch sms for an announcement
     * TODO: the actual sms api
     * Defferred sms sending + testing of services
     * @param type $room_type
     * @param type $room_id
     * @param type $announcement_id
     */
    public function sendSms($room_type, $room_id, $announcement_id) {
        App::uses('CakeTime', 'Utility');
        $SMS_LIMIT = 160;

        $conditions = array(
            'id' => 10
        );
        $options = array(
            'conditions' => $conditions,
            'recursive' => -1,
        );
        $data = $this->find('first', $options);
        $room = "classroom";
        $roomName = "Phy-101";


        $friendlyTime = CakeTime::format(
            'd-m-Y h:i A', $data['Announcement']['creation_date']
        );

        $rawString = 'Announcement in classroom Phy-101, from teacher_name about Sex on the beach sent at 14-03-2014 12:48 PM';
        $rawLength = strlen($rawString);
        $usableLength = $SMS_LIMIT - $rawLength;

        $smsString = String::insert('Announcement in :room :roomName, from :name about :subject sent at :timestamp', array(
            'name' => 'teacher_name',
            'room' => $room,
            'roomName' => $roomName,
            'subject' => $data['Announcement']['subject'],
            'timestamp' => $friendlyTime
        ));

        debug($smsString);
        die();

        // generates: "My name is Bob and I am 65 years old."
    }

    /**
     * Sends defferred emails
     * @param $classroomId
     * @param $announcement
     * @return bool
     */
    public function sendEmails($classroomId, $announcement) {

        $options['contain'] = array(
            'Classroom' => array(
                'fields' => array('id')
            ),
            'AppUser' => array(
                'fields' => array('id', 'email')
            )
        );

        $options['conditions'] = array(
            'UsersClassroom.classroom_id' => $classroomId
        );
        $data = $this->Classroom->UsersClassroom->find('all', $options);
        $emails = Hash::extract($data, '{n}.AppUser.email');

        App::uses('EmailLib', 'Tools.Lib');

        $Email = new EmailLib();
        $Email->to($emails);
        $Email->subject($announcement['Announcement']['subject']);
        $body = $announcement['Announcement']['body'] . PHP_EOL . PHP_EOL . Router::url('/', true) . 'Classrooms/' . $classroomId . '/Announcements';
        $result = $Email->send($body);

        $command = APP . "Console/cake Queue.Queue runworker > /dev/null 2>&1 &";
        exec($command);

        return $result;
    }

    public function allowCreate($classroomId, $userId) {
        $isModerator = $this->Classroom->isModerator($userId, $classroomId);
        $isOwner = $this->Classroom->isOwner($userId, $classroomId);

        if ($isModerator || $isOwner) {
            return true;
        } else {
            return false;
        }
    }
}
