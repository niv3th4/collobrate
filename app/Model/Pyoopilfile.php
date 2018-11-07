<?php

App::uses('AppModel', 'Model');
App::uses('AttachmentBehavior', 'Uploader.Model/Behavior');

/**
 *
 * @property Topic $Topic
 * @property Announcement $Announcement
 * @property Submission $Submission
 * @property UsersSubmission $UsersSubmission
 */
class File extends AppModel {

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'topic_id',
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

    );
 

    public $actsAs = array(
        'Uploader.Attachment' => array(
            'file_path' => array(
                'overwrite' => true,
//                'tempDir' => 'tmp',
//                'uploadDir' => 'uploads',
                'transport' => array(
                    'class' => AttachmentBehavior::S3,
                    'region' => Aws\Common\Enum\Region::SINGAPORE,
                    'folder' => 'libraries/',
                    'accessKey' => 'AKIAJSFESXV3YYXGWI4Q',
                    'secretKey' => '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',
                //Dynamically add 'accesskey','secretKey','bucket'
                ),
                'metaColumns' => array(
//                  'ext' => 'extension',
                    'type' => 'mime_type',
                    'size' => 'filesize',
                    'name' => 'filename'
//                  'exif.model' => 'camera'
                ),
                'transforms' => array(
                    'thumbnail_path' => array(
                        'class' => 'resize',
//                        'append' => '-chota',
//                        'height' => 200,
                        'width' => 200,
//                        'height' => 400,
                        'aspect' => true,
                        'modes' => 'width',
                        'expand' => 'false'
                    )
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

    public function beforeUpload($options) {
//        debug($options);
//        debug($this->data);
//        die();
        if ($this->data['file']['file_path']['type'] == 'image/jpeg') {
            $this->log("transformation detected");
//            debug($options);
//            $options['transforms'] = array(
//                'thumbnail_path' => array(
//                    'class' => 'resize',
////                        'append' => '-chota',
////                        'height' => 200,
//                    'width' => 200,
////                        'height' => 400,
//                    'aspect' => true,
//                    'mode' => 'width',
//                    'expand' => 'false'
//                )
//            );
        } else {
            $this->log("Removing transformation");
            unset($options['transforms']);
            //no transformation
//            unset($options['t'])
        }
        return $options;
    }

}
