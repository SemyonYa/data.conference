<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Doc */

$this->title = 'Добаление документа';
$this->params['breadcrumbs'][] = ['label' => 'Презентации', 'url' => '/presentation/index'];
$this->params['breadcrumbs'][] = ['label' => $presentation->name, 'url' => '/presentation/view?id=' . $presentation->id];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('model')) ?>

</div>