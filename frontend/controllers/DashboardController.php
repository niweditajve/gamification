<?php
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
use common\models\Categories;
use common\models\Skills;
use common\models\Agentlastlogin;
use common\models\Usercallcenters;

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
        
        $agent = Yii::$app->agentcomponent->getAgentId();
        
        $agentId = $agent['AgentID'];

        $parentTenentId = Yii::$app->agentcomponent->getAgentTenantId($agentId);
        
        $skillType = "Consumer";

        return $this->render('consumer', [
                    'model'         => $model,
                    'profile'       => $this->getProfilePic(),
                    'skillType'     => $skillType,
                    'category'      => $this->getCategories(),
                    'community'     => $this->getCommunity("Consumer",$parentTenentId),
                    'agentId'       => $agentId,
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

            $category[$catKey['category_key']] = array(
                "title" => $catKey['title'],
                "redCutOff" => $catKey['red_cut_off'],
                "yellowCutOff" => $catKey['yellow_cut_off'],
            );
        }

        return $category;
    }
    
    /**
     * Get communities for a skill type.
     * @param string $skillType
     * @return array of communities.
     */
    public function getCommunity($skillType, $parentTenentId) {
        
        $getGameAdminId = Usercallcenters::find()->select('callcenter_define_id')->where([ 'tenant_id' => $parentTenentId ])->one();
        
        $gameAdminId = $getGameAdminId['callcenter_define_id'];

        $skills = Skills::find()->where(["skill" => $skillType , 'game_admin_id' => $gameAdminId])->one();

        $skillArray = json_decode($skills['sales_source_Id']);

        return (is_array($skillArray)) ? implode(",", $skillArray) : "";
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
        
        $agent = Yii::$app->agentcomponent->getAgentId();
        
        $agentId = $agent['AgentID'];

        $parentTenentId = Yii::$app->agentcomponent->getAgentTenantId($agentId);

        return $this->render('business', [
                    'model'         => $model,
                    'profile'       => $this->getProfilePic(),
                    'skillType'     => $skillType,
                    'category'      => $this->getCategories(),
                    'community'     => $this->getCommunity("Business", $parentTenentId),
                    'agentId'       => $agentId,
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
        
        $agent = Yii::$app->agentcomponent->getAgentId();
        
        $agentId = $agent['AgentID'];

        $parentTenentId = Yii::$app->agentcomponent->getAgentTenantId($agentId);

        return $this->render('dealer', [
                    'model'         => $model,
                    'profile'       => $this->getProfilePic(),
                    'skillType'     => $skillType,
                    'category'      => $this->getCategories(),
                    'community'     => $this->getCommunity("Dealer", $parentTenentId),
                    'agentId'       => $agentId,
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
