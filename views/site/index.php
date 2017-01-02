<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="site-index">
        <div class="row">
            <div class="social pull-right">
                <?= yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['site/auth']
                ]) ?>
            </div>
        </div>
    </div>

</div>
