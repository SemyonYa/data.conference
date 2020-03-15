<div class="front-schedele-presentations">
    <h3 class="">
        <?= $schedule->date ?> <br>
        <?= $schedule->time ?> <br>
        <?= $schedule->name ?>
    </h3>
    <hr>
    <?php foreach ($presentations as $presentation) : ?>
        <a href="/front/presentation?id=<?= $presentation->id ?>">
            <div class="front-schedele-presentations-item">
                <p><strong><?= $presentation->name ?></strong><br></p>
                <p class="front-schedele-presentations-item-org"><?= $presentation->organization ?><br></p>
                <?php foreach ($presentation->presentationPeople as $pp): ?>
                    <p><?= $pp->person->surnameName . ' ' . $pp->person->name_2 ?></p>
                <?php endforeach; ?>
                <hr>
            </div>
        </a>
    <?php endforeach; ?>
</div>