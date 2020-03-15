<?php

use app\models\Section;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presentation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'organization')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_id')->dropDownList(
        Section::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выбрать секцию']
    ) ?>

    <?= $form->field($model, 'ordering')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'is_visible')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>