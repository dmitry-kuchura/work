<?php /* @var $result Users */ ?>

<?php echo CHtml::link('Add / Create', '#', ['class' => 'btn btn-success modal-btn', 'data-target' => 'api/user-create']); ?>
    <hr>
<?php if ($result): ?>
    <ul id="usersData" class="list-group usersData">
        <?php foreach ($result as $obj): ?>
            <li class="list-group-item usersData-item">
                <div class="usersData-item__text" id="<?php echo $obj->id; ?>">
                    <?php echo $obj->name . ' / ' . $obj->email . ' / '; ?>
                    <?php echo $obj->company->id ? $obj->company->name : 'Company deleted!'; ?>
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
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p>No data user to view. Please create user click to <strong>Add / Create</strong> button.</p>
    </div>
<?php endif; ?>