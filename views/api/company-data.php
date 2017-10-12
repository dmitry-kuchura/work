<?php /* @var $obj Companies */ ?>
<li class="list-group-item usersData-item">
    <div class="usersData-item__text" id="<?php echo 'company-' . $obj->id; ?>"><?php echo $obj->name . ' / ' . Helper::fileSizeConvert($obj->quota); ?></div>
    <div class="usersData-item__buttons">
        <button class="btn btn-info modal-btn"
                data-target="<?php echo Yii::app()->createUrl('api/company-update', ['id' => $obj->id]); ?>">
            Edit
        </button>
        <button class="btn btn-danger deleteButton"
                data-table="companies"
                data-id="<?php echo $obj->id; ?>">
            Delete
        </button>
    </div>
</li>