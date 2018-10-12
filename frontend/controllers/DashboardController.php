<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use common\models\Categories;
use common\models\Skills;
use common\models\Agentlastlogin;

class DashboardController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
         return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['suggest', 'queue', 'delete', 'update'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['consumer', 'business', 'dealer'],
                        'roles' => ['virtual_user'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        
        $model = new User();

        $skillType = "Business";

        $profile = User::find()
                ->select('profile_pic')
                ->where(['id' => Yii::$app->user->id])
                ->one();

        return $this->render('business', [
                    'model'         => $model,
                    'profile'       => $profile['profile_pic'],
                    'skillType'     => $skillType,
        ]);
    }
    
    /**
     * Dashboard for consumer skill.
     * @param 
     * @return mixed
     */
    public function actionConsumer() {
        
        $this->updateLastLogin();
        
        $model = new User();

        $skillType = "Consumer";

        return $this->render('consumer', [
                    'model'         => $model,
                    'profile'       => $this->getProfilePic(),
                    'skillType'     => $skillType,
                    'category'      => $this->getCategories(),
                    'community'     => $this->getCommunity("Consumer"),
        ]);
    }
    
    /**
     * Get all categories.
     * @param
     * @return array of categories.
     */
    public function getCategories() {

        $categories = Categories::find()->all();

        $category = array();

        foreach ($categories as $catKey) {

            $category[$catKey['categoeryKey']] = array(
                "title" => $catKey['title'],
                "redCutOff" => $catKey['redCutOff'],
                "yellowCutOff" => $catKey['yellowCutOff'],
            );
        }

        return $category;
    }
    
    /**
     * Get communities for a skill type.
     * @param string $skillType
     * @return array of communities.
     */
    public function getCommunity($skillType) {

        $skills = Skills::find()->where(["skill" => $skillType])->one();

        $skillArray = json_decode($skills['salesSourceId']);

        return implode(",", $skillArray);
    }
    
    /**
     * Get Profile picture of logged in agent
     * @param 
     * @return filename of profile picture.
     */
    public function getProfilePic() {

        $profile = User::find()
                ->select('profile_pic')
                ->where(['id' => Yii::$app->user->id])
                ->one();

        return $profile['profile_pic'];
    }

    /**
     * Dashboard for business skill.
     * @param 
     * @return mixed
     */
    public function actionBusiness() {
        
        $this->updateLastLogin();

        $model = new User();

        $skillType = "Business";

        return $this->render('business', [
                    'model'         => $model,
                    'profile'       => $this->getProfilePic(),
                    'skillType'     => $skillType,
                    'category'      => $this->getCategories(),
                    'community'     => $this->getCommunity("Business"),
        ]);
    }
    
    /**
     * Dashboard for dealer skill.
     * @param 
     * @return mixed
     */
    public function actionDealer() {
        
        $this->updateLastLogin();

        $model = new User();

        $skillType = "Dealer SalesOnCall";

        return $this->render('dealer', [
                    'model'         => $model,
                    'profile'       => $this->getProfilePic(),
                    'skillType'     => $skillType,
                    'category'      => $this->getCategories(),
                    'community'     => $this->getCommunity("Dealer"),
        ]);
    }
    
    
    public function updateLastLogin(){
        
        $agent = Yii::$app->agentcomponent->getAgentId();
        
        $agentId = $agent['AgentID'];
        
        if($agentId){
            
            $model = new Agentlastlogin();

            $model->agent_id=$agentId;

            $model->hit_time= date("Y-m-d H:i:s");

            $model->save();
        }
        
    }

}
