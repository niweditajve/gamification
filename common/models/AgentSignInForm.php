<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\AuthAssignment;
use common\models\AuthItem;

use yii\helpers\Url;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AgentSignInForm extends Model
{
    public $Login;
    public $Password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblagent';
        
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['Login', 'Password'], 'required'],
            // rememberMe must be a boolean value
             ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['Password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->Password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    public function signIn()
    {
        
        $userExists = $this->getUser();
        
        if(!$userExists){

            $arr = explode("@", $this->Login, 2);
           
            $model = new User;
            $model->email = $this->Login;
            $model->username = $arr[0];
            $model->password_hash = sha1($this->Password);
            //User::generateAuthKey();
            //$model->auth_key = User::getAuthKey();

           
            if($model->save(false)){

                $model->id;

                $authAssignmentmodel = new AuthAssignment;
                $authAssignmentmodel->item_name = 'virtual_user';
                $authAssignmentmodel->user_id = $model->id;
                $authAssignmentmodel->created_at = time();
                
                $authAssignmentmodel->save(false);
               
            }

            //$this->changePassword();

        }else{

            $this->agentsignIn();
            
        }
        
         
    }

    public function agentsignIn(){

        if ($this->validate()) {
            Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
           
            return Yii::$app->response->redirect(Url::to(['dashboard/index']));
        }
    }   

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
           
            $this->_user = User::findByUsername($this->Login);
        }
        return $this->_user;
    }

    public function getEmail()
    {
        if ($this->_user === false) {
           
            $this->_user = User::findByEmail($this->Login);
        }
        return $this->_user;
    }



}
