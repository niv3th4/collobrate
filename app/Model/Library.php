<?php

App::uses('AppModel', 'Model');
App::uses('AttachmentBehavior', 'Uploader.Model/Behavior');

/**
 * Library Model
 *
 * @property Classroom $Classroom
 * @property Topic $Topic
 */
class Library extends AppModel {

    const PAGINATION_LIMIT = 15;

    /**
     * Notes:
     * On addition of files, getSize() and add to fileSize db field.
     * allow/dissallow file upload if Library->fileSize is not exceeded
     */
    public $actsAs = array(
        'Uploader.Attachment' => array(
            'file_path' => array(
                'overwrite' => true,
                'transport' => array(
                    'class' => AttachmentBehavior::S3,
                    'region' => Aws\Common\Enum\Region::SINGAPORE,
                    'folder' => 'libraries/',
                    'accessKey' => 'AKIAJSFESXV3YYXGWI4Q',
                    'secretKey' => '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',
                    'bucket' => 'collabrate-files',
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
        )
    );

    /**
     * hasMany associations
     * @var array
     */
    public $hasMany = array(
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'library_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    /**
     * Create a Library for a Classroom
     * @param type $classroomId Classroom(pk)
     * @return boolean success/failure of save()
     */
    public function add($classroomId) {
        $data = array(
            'Classroom' => array(
                'id' => $classroomId
            ),
            'Library' => array(
                'filesize' => '0'
            )
        );
        $this->create();
        if ($this->saveAssociated($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update the topic
     * @param $topicId
     * @param $topicText
     * @return bool
     */
    public function editTopic($topicId, $topicText) {

        //sanity check
        //if topic exists
        $conditions = array(
            'id' => $topicId
        );
        if (!$this->Topic->hasAny($conditions)) {
            return false;
        }

        $data = array(
            'Topic' => array(
                'id' => $topicId,
                'name' => $topicText
            )
        );

        return $this->Topic->save($data);
    }

    /**
     * get libraryId from classroomId
     * @param $classroomId
     * @return mixed
     */
    public function getLibraryId($classroomId) {

        $params['conditions'] = array(
            'classroom_id' => $classroomId
        );

        $params['recursive'] = -1;

        $data = $this->find('first', $params);

        return $data['Library']['id'];
    }

    /**
     * delete topic based on TopicId
     * @param $topicId
     * @return bool true for success
     */
    public function deleteTopic($topicId) {
        return $this->Topic->delete($topicId);
    }

    public function getPaginatedTopics($libraryId, $page = 1) {

        $offset = self::PAGINATION_LIMIT * ($page - 1);

        $params['conditions'] = array(
            'library_id' => $libraryId,
        );

        $params['contain'] = array(
            'Link',
            
        );

        $params['limit'] = self::PAGINATION_LIMIT;
        $params['offset'] = $offset;

        return $topics = $this->Topic->find('all', $params);
    }

    /**
     * get a topic based on topicId
     * @param $topicId
     * @return array
     */
    public function getTopic($topicId) {
        $options = array(
            'conditions' => array(
                'Topic.id' => $topicId
            ),
            'contain' => array(
                'Link'
            )
        );
        return $this->Topic->find('first', $options);
    }

    /**
     * delete an item (File or Link) from the topic
     * @param $type File or Link
     * @param $id
     * @return bool
     */
    public function deleteItem($type, $id) {

        if ($type == 'File') {
            return @$this->Topic->file->delete($id);
        } elseif ($type == 'Link') {
            return @$this->Topic->Link->delete($id);
        }
    }

    /**
     * parse links and determine if they are videos
     * (only youtube supported)
     * @param $data Link associative array
     * @return mixed
     */
    public function parseVideoLinks($data) {
        //ultimate youtube regex
        //http://stackoverflow.com/a/10315969/1881812
        $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/';
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['Video'] = array();
            for ($j = 0; $j < count($data[$i]['Link']); $j++) {
                $linkText = $data[$i]['Link'][$j]['linktext'];
                if (preg_match($pattern, $linkText)) {
                    $youtubeLink = array(
                        'id' => $data[$i]['Link'][$j]['id'],
                        'topic_id' => $data[$i]['Link'][$j]['topic_id'],
                        'linktext' => $data[$i]['Link'][$j]['linktext'],
                        'created' => $data[$i]['Link'][$j]['created']
                    );
                    array_push($data[$i]['Video'], $youtubeLink);
                    unset($data[$i]['Link'][$j]);
                }
            }
            $data[$i]['Link'] = array_values($data[$i]['Link']);
            $data[$i]['Video'] = array_values($data[$i]['Video']);
        }
        return $data;
    }

    /**
     * Parse file based on mimeTypes
     * and categories Documents, Links, Videos, Presentations, Pictures
     * @param $data file associative array
     * @return mixed
     */
    public function parsefiles($data) {

        /* MIME types supported
         * images: image/jpeg, image/png, image/gif, image/tiff, image/tiff-fx, image/bmp, image/x-bmp
         * documents: application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, text/plain, application/pdf, application/x-pdf, application/x-bzpdf, application/x-gzpdf
         * presentations: application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation
         */

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['Documents'] = array();
            $data[$i]['Pictures'] = array();
            $data[$i]['Presentations'] = array();
        }
        return $data;
    }

    /**
     * determine if user of $userID has permission to perform CUD (Create, Update, Delete)
     * in a given classroom of $classroomId
     * @param $classroomId
     * @param $userId
     * @return bool
     */
    public function allowCUD($classroomId, $userId) {
        $isModerator = $this->Classroom->isModerator($userId, $classroomId);
        $isOwner = $this->Classroom->isOwner($userId, $classroomId);

        if ($isModerator || $isOwner) {
            return true;
        } else {
            return false;
        }
    }
}
