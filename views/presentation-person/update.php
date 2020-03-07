<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PresentationPerson */

$this->title = 'Update Presentation Person: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Presentation People', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="presentation-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
