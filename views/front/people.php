<?php
/* @var $this yii\web\View */
$this->title = 'Участники';
?>

<h1 class="text-center"><?= $this->title ?></h1>
<div class="people-menu">
    <?php foreach ($person_roles as $id => $role) : ?>
        <div class="people-menu-item <?= $id === 0 ? 'people-menu-item-active' : '' ?>" data-id="<?= $role->id ?>" onclick="roleOn(event)"><?= $role->name ?></div>
    <?php endforeach; ?>
</div>

<?php foreach ($person_roles as $id => $role) : ?>
    <div class="people-list <?= $id !== 0 ? 'disabled' : '' ?>" id="people-list-<?= $role->id ?>">
        <?php if (count($role->people) === 0) : ?>
            <div class="alert alert-info">
                Нет информации об участниках
            </div>
        <?php endif; ?>
        <?php foreach ($role->people as $person) : ?>
            <div class="people-list-item" data-toggle="modal" data-target="#ConferenceFrontModal" onclick="showPerson(<?= $person->id ?>)">
                <div class="people-list-item-photo"></div>
                <div class="people-list-item-info">
                    <h4><?= $person->surnameName ?></h4>
                    <p><?= $person->organization ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>