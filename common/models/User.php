<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $unconfirmed_email
 * @property string $registration_ip
 * @property int $flags
 * @property string $profile_pic
 * @property int $confirmed_at
 * @property int $blocked_at
 * @property int $updated_at
 * @property int $created_at
 * @property int $last_login_at
 * @property string $auth_tf_key
 * @property int $auth_tf_enabled
 * @property int $password_changed_at
 *
 * @property Profile $profile
 * @property SocialAccount[] $socialAccounts
 * @property Token[] $tokens
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'updated_at', 'created_at'], 'required'],
            [['flags', 'confirmed_at', 'blocked_at', 'updated_at', 'created_at', 'last_login_at', 'auth_tf_enabled', 'password_changed_at'], 'integer'],
            [['username', 'email', 'unconfirmed_email','profile_pic'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['auth_tf_key'], 'string', 'max' => 16],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'unconfirmed_email' => 'Unconfirmed Email',
            'registration_ip' => 'Registration Ip',
            'flags' => 'Flags',
            'profile_pic' => 'Profile Picture',
            'confirmed_at' => 'Confirmed At',
            'blocked_at' => 'Blocked At',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'last_login_at' => 'Last Login At',
            'auth_tf_key' => 'Auth Tf Key',
            'auth_tf_enabled' => 'Auth Tf Enabled',
            'password_changed_at' => 'Password Changed At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }


    public function getProfilePictureFile()
    {
        return isset($this->profile_pic) ? Yii::$app->params['uploadPath'] . 'user/profile/' . $this->profile_pic : null;
    }

    public function getProfilePictureUrl()
    {
        // return a default image placeholder if your source profile_pic is not found
        $profile_pic = isset($this->profile_pic) ? $this->profile_pic : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] . 'user/profile/' . $profile_pic;
    }

    /**
    * Process upload of profile picture
    *
    * @return mixed the uploaded profile picture instance
    */
    public function uploadProfilePicture() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'profile_pic');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        //$this->filename = $image->name;
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->profile_pic = Yii::$app->security->generateRandomString().".{$ext}";
        var_dump($image);
        // the uploaded profile picture instance
        return $image;
    }
}
