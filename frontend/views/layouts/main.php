<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Html::img('@web/images/image.png', ['alt'=>Yii::$app->params['name']]),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            if (Yii::$app->user->isGuest) {
                $navItems = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                ];
            } else {
                $navItems = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                     
                    ['label' => 'Category', 'url' => ['#'],
                        'items' => [
                            ['label' => 'Consumer', 'url' => ['/dashboard/consumer']],
                            ['label' => 'Business', 'url' => ['/dashboard/business']],
                            ['label' => 'Dealer', 'url' => ['/dashboard/dealer']],
                        ],
                        'visible' => Yii::$app->user->can('virtual_user')
                    ],
                    
                    ['label' => 'IVR', 'url' => ['#'],
                        'items' => [
                            ['label' => 'TFN', 'url' => ['/tfnlist/index'], 'visible' => Yii::$app->user->can('admin_cc')],
                            ['label' => 'Agents', 'url' => ['/agent/index'], 'visible' => Yii::$app->user->can('admin_agents')],
                            ['label' => 'Call Centers', 'url' => ['/callcenter/index'], 'visible' => Yii::$app->user->can('admin_cc')],
                            ['label' => 'Call Data Quick ', 'url' => ['/call-data/indexquick'], 'visible' => Yii::$app->user->can('transcript_user')],
                           
                        ],
                        'visible' => Yii::$app->user->can('transcript_user')
                    ],
                    
                    
                ];
            }
            if (Yii::$app->user->isGuest) {
                //   array_push($navItems, ['label' => 'Sign In', 'url' => ['/user/login']], ['label' => 'Sign Up', 'url' => ['/user/register']]);
                array_push($navItems, ['label' => 'Login', 'url' => ['/user/security/login']]);
                //array_push($navItems, ['label' => 'Agent Login', 'url' => ['/skill/signin']]);
                //array_push($navItems, ['label' => 'Login In', 'url' => ['/user/security/login']], ['label' => 'Sign Up', 'url' => ['/user/registration/register']]);
            } else {
                array_push($navItems, ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']]
                );
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $navItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; RM Factory <?= date('Y') ?></p>


            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
