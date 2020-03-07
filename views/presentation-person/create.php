<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PresentationPerson */

$this->title = 'Добаление докладчика';
$this->params['breadcrumbs'][] = ['label' => 'Презентации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $presentation->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presentation-person-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', compact('model', 'people')) ?>

</div>
