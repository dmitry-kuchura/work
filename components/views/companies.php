<?php /* @var $result Companies */ ?>
<?php echo CHtml::link('Add / Create', '#', ['class' => 'btn btn-success modal-btn', 'data-target' => 'api/company-create']); ?>
<hr>
<ul id="companyData" class="list-group usersData">
<?php if ($result): ?>
    <?php foreach ($result as $obj): ?>
        <li class="list-group-item usersData-item">
            <div class="usersData-item__text"
                 id="<?php echo 'company-' . $obj->id; ?>"><?php echo $obj->name . ' / ' . Helper::fileSizeConvert($obj->quota); ?></div>
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
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p>No data companies to view. Please create company click to <strong>Add / Create</strong> button.</p>
    </div>
<?php endif; ?>
</ul>