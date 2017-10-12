<?php

/* @var $this Controller */
/* @var $content string */

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <?php $this->head(); ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="wrap">
    <nav class="navbar-inverse navbar-fixed-top navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <?php echo CHtml::link('Yii 1.x WEB Framework', '/', ['class' => 'navbar-brand']); ?>
            </div>
            <div class="collapse navbar-collapse"></div>
        </div>
    </nav>
    <div class="container">
        <?php echo $content ?>
    </div>
</div>
<?php $this->footer(); ?>
</body>
</html>
