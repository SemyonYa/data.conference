<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Презентации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="presentation-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('<span class="glyphicon glyphicon-edit">', ['update', 'id' => $model->id], ['class' => '']) ?>
    <?= Html::a('<span class="glyphicon glyphicon-remove">', ['delete', 'id' => $model->id], [
        'class' => '',
        'data' => [
            'confirm' => 'Действительно удалить?',
            'method' => 'post',
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'organization',
            'is_visible',
        ],
    ]) ?>
    <hr>
    <div class="presentation-persons">
        <h3>Докладчики</h3>
        <ol>
            <?php foreach ($model->presentationPeople as $p_person) : ?>
                <li>
                    <?= $p_person->person->nameSurname ?>
                    <?= $p_person->is_coauthor ? '<span class="text-info" style="font-size: 9px">(соавтор)</span>' : '' ?>
                </li>
            <?php endforeach; ?>
            <a href="/presentation-person/create?presentation_id=<?= $model->id ?>"><span class="glyphicon glyphicon-plus-sign"></span></a>
        </ol>
    </div>
    <hr>
    <div class="presentation-docs">
        <h3>Документы</h3>
        <ul>
            <?php foreach ($model->docs as $doc) : ?>
                <li>
                    <span><?= $doc->name ?></span>
                    <a href="<?= Yii::getAlias('@web/web/docs/' . $doc->path); ?>" target="_blank" rel="noopener noreferrer" download="<?= $doc->name ?>">
                        <span class="glyphicon glyphicon-download"></span>
                    </a>
                    <a href="<?= Yii::getAlias('@web/web/docs/' . $doc->path); ?>" target="_blank" rel="noopener noreferrer">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="/doc/create?presentation_id=<?= $model->id ?>"><span class="glyphicon glyphicon-upload"></span></a>
    </div>
</div>