<div class="person-wrap">
    <h3>
        <strong><?= $person->surname ?><br></strong>
        <?= $person->name ?> <?= $person->name_2 ?>
    </h3>
    <hr>
    <div class="person-photo-wrap">
        <div class="person-photo" style="background-image: url('/web/images/<?= $person->photo ?>')"></div>
    </div>
    <hr>
    <h4><?= $person->organization ?></h4>
    <h5><?= $person->vocation ?></h5>
    <h6><?= $person->personRole->name ?></h6>
    <hr>
    <p><?= $person->info ?></p>
</div>