<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Презентации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presentation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'organization',
            'is_visible',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
