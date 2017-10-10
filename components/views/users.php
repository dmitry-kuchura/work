<?php /* @var $result Users */ ?>

<a class="btn btn-success modal-btn" data-target="#">Add / Create</a>
<hr>
<?php if ($result): ?>
    <ul id="usersData" class="list-group usersData">
        <?php foreach ($result as $obj): ?>
            <li class="list-group-item usersData-item">
                <div class="usersData-item__text"><?php echo $obj->name . ' / ' . $obj->email . ' / '; ?><?php echo $obj->company->id ? $obj->company->name : 'Company deleted!'; ?></div>
                <div class="usersData-item__buttons">
                    <button class="btn btn-info modal-btn"
                            data-target="#">Edit
                    </button>
                    <button class="btn btn-danger deleteButton" data-table="users" data-id="<?php echo $obj->id; ?>">
                        Delete
                    </button>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p>No data user to view. Please create user click to <strong>Add</strong> button.</p>
    </div>
<?php endif; ?>