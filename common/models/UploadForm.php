<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class UploadForm extends Model {

    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            //[['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv'],
            [['file'], 'file', 'skipOnEmpty' => false,'mimeTypes' => 'text/csv, text/plain'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'file' => 'File Upload',
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function upload() {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

}
