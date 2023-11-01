<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\BaseUrl;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
// $this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
// $this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark ']
    ]);

    $navItems = [];
    $navItems[] = ['label' => 'Home', 'url' => ['/site/index']];
    $navItems[] = ['label' => 'About', 'url' => ['/site/about']];
    $navItems[] = ['label' => 'Properties', 'url' => ['/site/properties']];

    if( ! Yii::$app->user->isGuest ) {


        if( Yii::$app->user->identity->role == 1 ) {
            $navItems[] = [ 'label' => 'Dashboard', 'url' => ['/dashboard'] ];
        }

        $profileImage = '/uploads/avatars/';
        $profileImage .= ( ! empty( Yii::$app->user->identity->profile_image ) ) ? Yii::$app->user->identity->profile_image : 'placeholder.png'; 

        $navItems[] = [
            'label' => '<span><img src="' . BaseUrl::base().$profileImage . '" class="navbar-profile-image" /></span>',
            'items' => [
                '<p class="navbar-profile-user">' . Yii::$app->user->identity->full_name . '</p>',
                ( Yii::$app->user->identity->role == 1 ) ? ['label' => 'Dashboard', 'url' => ['/dashboard']] : '',
                ['label' => 'Profile', 'url' => ['/users/profile'] ],
                Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Logout',
                    ['class' => 'dropdown-item']
                )
                . Html::endForm()
            ],
            'encode' => false,
            'options' => [ 'class' => 'ms-md-auto' ]
        ];
        
    }else {                
        $navItems[] = [ 'label' => 'Login', 'url' => [ '/login' ], 'options' => [ 'class' => 'ms-md-auto' ] ];
        $navItems[] = [ 'label' => 'Register', 'url' => [ '/register' ],  ];
    }


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav w-100 align-items-center'],
        'items' => $navItems

    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0 mt-5" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?php Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
