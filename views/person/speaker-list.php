<div class="speaker-list">
    <h3>Список докладчиков</h3>
    <hr>
    <div class="speakers">
        <?php foreach ($speakers as $speaker) : ?>
            <div class="speakers-item">
                <input type="checkbox" value="<?= $speaker->id ?>" <?= in_array($speaker->id, $presentation_people_ids) ? 'checked' : '' ?>>
                <span><?= $speaker->nameSurname ?></span>
            </div>
        <?php endforeach; ?>
        <span class="glyphicon glyphicon-ok ok-btn"></span>
    </div>
</div>