<?php

/* @var $result TransferLogs */
/* @var $months [] */

?>
<div class="row">
    <?php echo CHtml::button('Generate Data', ['class' => 'btn btn-default generateData']) ?>
    <?php echo CHtml::dropDownList('month', null, $months, ['class' => 'monthSelect', 'id' => 'monthSelect']); ?>
    <?php echo CHtml::button('Generate Report', ['class' => 'btn btn-default generateReport']) ?>
</div>
<div id="transfer">
    <h1>Transfer logs</h1>
    <?php if ($result): ?>
        <table class="table">
            <thead>
            <tr>
                <th>User</th>
                <th>Date/time</th>
                <th>Resource</th>
                <th>Transferred</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $obj): ?>
                <tr>
                    <td><?php echo $obj->user->name ? $obj->user->name : '<strong>User deleted!</strong>'; ?></td>
                    <td><?php echo date('d M Y H:i:s', $obj->date_time); ?></td>
                    <td><?php echo $obj->resource; ?></td>
                    <td><?php echo Helper::fileSizeConvert($obj->transferred); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            <p>No data to show. Please, press <strong>Generate Data</strong>!</p>
        </div>
    <?php endif; ?>
</div>
<div class="report" id="report"></div>