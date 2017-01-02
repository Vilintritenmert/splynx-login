<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Signup';
?>
<div class="site-index">
    <div class="row">
        <div class="signup-form">
            <div class="row main">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <h1 class="title">Your information</h1>
                        <hr/>
                    </div>
                </div>
                <div class="main-login main-center">
                    <?php $form = ActiveForm::begin([
                        'id' => 'contact-form',
                        'action' => ['site/signup'],
                        'options' => ['method' => 'post'],
                        'fieldConfig' => [
                            'options' => [
                                'tag' => false,
                            ],
                        ]]); ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">Your Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'Enter your name'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Your Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"
                                                                      aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'email')->input('email', ['type' => 'email', 'placeholder' => 'Email', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">City</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'city')->input('text', ['placeholder' => 'City', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"
                                                                      aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Street 1</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'street_1')->input('text', ['placeholder' => 'Street 1', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Street 2</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'street_2')->input('text', ['placeholder' => 'Address', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Zip Code</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'zip_code')->input('text', ['placeholder' => 'Zip Code', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"
                                                                      aria-hidden="true"></span></span>
                                        <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => 'Confirm Password', 'class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary form-control', 'name' => 'contact-button']) ?>
                        </div>
                    </div>

                    <?= $form->errorSummary($model); ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>

</div>
