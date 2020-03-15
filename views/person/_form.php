<?php

use app\models\PersonRole;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_role_id')->dropdownList(
        PersonRole::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Роль участника']
    ); ?>

    <?= $form->field($model, 'organization')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'photo')->hiddenInput() ?>
    <img src="/web/<?= $model->photo ? 'images/' . $model->photo : 'icons/image-outline.png' ?>" class="img-preview" id="ConferenceImgPreview" data-toggle="modal" data-target="#ConferenceModal" onclick="LoadImageManager('person-photo')" alt="Нужно выбрать другое изображение...">

    <?= $form->field($model, 'is_visible')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>