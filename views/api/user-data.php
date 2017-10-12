<?php /* @var $obj Users */ ?>
<li class="list-group-item usersData-item">
    <div class="usersData-item__text" id="<?php echo 'user-' . $obj->id; ?>">
        <?php echo $obj->name . ' / ' . $obj->email . ' / '; ?>
        <?php echo isset($obj->company->id) ? $obj->company->name : 'Company deleted!'; ?>
    </div>
    <div class="usersData-item__buttons">
        <button class="btn btn-info modal-btn"
                data-target="<?php echo Yii::app()->createUrl('api/user-update', ['id' => $obj->id]); ?>">
            Edit
        </button>
        <button class="btn btn-danger deleteButton"
                data-table="users" data-id="<?php echo $obj->id; ?>">
            Delete
        </button>
    </div>
</li>