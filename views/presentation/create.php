<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */

$this->title = 'Новая презентация';
$this->params['breadcrumbs'][] = ['label' => 'Презентации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presentation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>
