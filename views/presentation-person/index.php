<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresentationPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presentation People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presentation-person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Presentation Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'presentation_id',
            'person_id',
            'is_coauthor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
