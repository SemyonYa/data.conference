<?php
/* @var $this yii\web\View */
$this->title = 'Список докладов';
?>

<div class="front-presentations-wrap">
    <h1 class="text-center"><?= $this->title ?></h1>
    <?php if (count($sections) > 0) : ?>
        <?php foreach ($sections as $section) : ?>
            <div class="front-presentations-list">
                <h3><?= $section->name ?></h3>
                <?php foreach ($section->presentations as $presentation) : ?>
                    <div class="front-presentations-item">
                        <h4><?= $presentation->name ?> <a href="/front/presentation?id=<?= $presentation->id ?>">(подробнее...)</a></h4>
                        <p><strong><?= $presentation->organization ?></strong></p>
                        <p>
                            <?php foreach ($presentation->presentationPeople as $pp) : ?>
                                <span class="front-presentations-person" data-toggle="modal" data-target="#ConferenceFrontModal" onclick="showPerson(<?= $pp->person->id ?>)"><?= $pp->person->surnameName . ' ' . $person->name_2 ?></span>
                            <?php endforeach; ?>
                        </p>
                        <p><?= $presentation->description ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (count($zero_presentations) > 0) : ?>
        <div class="front-presentations-list">
            <?php foreach ($zero_presentations as $presentation) : ?>
                <div class="front-presentations-item">
                    <h4><?= $presentation->name ?> <a href="/front/presentation?id=<?= $presentation->id ?>">(подробнее...)</a></h4>
                    <p><strong><?= $presentation->organization ?></strong></p>
                    <div class="front-presentations-persons">
                        <?php foreach ($presentation->presentationPeople as $pp) : ?>
                            <div class="front-presentations-person" data-toggle="modal" data-target="#ConferenceFrontModal" onclick="showPerson(<?= $pp->person->id ?>)"><?= $pp->person->surnameName . ' ' . $person->name_2 ?></div>
                        <?php endforeach; ?>
                    </div>
                    <p><?= $presentation->description ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>