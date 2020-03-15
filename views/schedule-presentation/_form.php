<?php

use app\models\Presentation;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SchedulePresentation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-presentation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'presentation_id')->dropDownList(
        Presentation::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выбрать презентацию...']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
