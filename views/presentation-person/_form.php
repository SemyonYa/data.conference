<?php

// use app\models\Person;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PresentationPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presentation-person-form">

    <?php $form = ActiveForm::begin(); ?>

    <input type="hidden" name="PresentationPerson[presentation_id]" value="<?= $model->presentation_id ?>">
    <select name="PresentationPerson[person_id]" class="form-control">
        <option disabled selected>Выберите докладчика...</option>
        <?php foreach ($people as $person) : ?>
            <option value="<?= $person->id ?>"><?= $person->nameSurname ?></option>
        <?php endforeach; ?>
    </select>

    <?= $form->field($model, 'is_coauthor')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>