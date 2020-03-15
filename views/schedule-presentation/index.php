<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchedulePresentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedule Presentations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-presentation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Schedule Presentation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'schedule_id',
            'presentation_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
