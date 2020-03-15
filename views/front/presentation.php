<?php
/* @var $this yii\web\View */

$this->title = 'Доклады: ' . $presentation->name;
?>

<a href="/front/presentations">
    <div class="back-btn">
        <span class="glyphicon glyphicon-arrow-left"></span>
        <span>Список докладов</span>
    </div>
</a>
<div class="front-presentation-wrap">
    <div class="front-presentation-body">
        <h2><?= $presentation->name ?></h2>
        <h4><?= $presentation->organization ?></h4>
        <hr>
        <?php if ($presentation->section) : ?>
            <h5>Секция: <?= $presentation->section->name ?></h5>
            <hr>
        <?php endif; ?>
        <p><?= $presentation->description ?></p>
        <hr>
        <div class="front-presentation-docs">
            <?php foreach ($presentation->docs as $doc) : ?>
                <a href="<?= Yii::getAlias('@web/web/docs/' . $doc->path); ?>" target="_blank" rel="noopener noreferrer">
                    <div class="front-presentation-docs-item">
                        <div class="front-presentation-docs-item-icon"></div>
                        <span><?= $doc->name ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php if ($is_jury) : ?>
            <div class="front-presentation-marks">
                <div class="front-presentation-ratings">
                    <?php foreach ($ratings as $rating) : ?>
                        <div class="front-presentation-ratings-item">
                            <input type="radio" name="rating[]" class="front-presentation-rating-level" id="rating<?= $rating->id ?>" value="<?= $rating->level ?>" onclick="saveMark(<?= $presentation->id ?>)">
                            <label for="rating<?= $rating->id ?>"><?= $rating->name ?: $rating->level ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <textarea class="form-control front-marks-description" id="front-mark-description" rows="5" oninput="saveMark(<?= $presentation->id ?>)"></textarea>
            </div>
        <?php endif; ?>
    </div>
    <div class="front-presentation-persons">
        <?php foreach ($presentation->presentationPeople as $pp) : ?>
            <div class="front-presentation-person">
                <div class="front-presentation-person-photo"></div>
                <p class="front-presentation-person-fio">
                    <strong><?= $pp->person->surname ?></strong><br>
                    <?= $pp->person->name ?>
                    <?= $pp->person->name_2 ?>
                </p>
                <p class="front-presentation-person-vocation"><?= $pp->person->vocation ?></p>
                <div class="front-presentation-person-info"><?= $pp->person->info ?></div>
            </div>
        <?php endforeach ?>
    </div>
</div>