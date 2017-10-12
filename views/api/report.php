<?php

/* @var $result TransferLogs */
/* @var $months [] */
/* @var $month int */

?>

<h1><?php echo 'Report for ' . $months[$month] ?></h1>
<?php if ($result): ?>
    <ul id="report" class="list-group reportData">
        <?php foreach ($result as $obj): ?>
            <?php if ($obj->transferred > $obj->quota): ?>
                <li class="list-group-item usersData-item">
                    <div class="usersData-item__text">
                        <?php echo $obj->company_name . ' / ' . Helper::fileSizeConvert($obj->transferred) . ' / Limit: [' . Helper::fileSizeConvert($obj->quota) . ']'; ?>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>