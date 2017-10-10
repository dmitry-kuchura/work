<?php

/* @var $model Users */
/* @var $companies [] */
?>
<?php echo CHtml::beginForm(null, 'post', ['id' => 'user-form', 'class' => 'form-ajax']); ?>

    <div class="form-group">
        <?php echo CHtml::activeLabel($model, 'name', ['class' => 'control-label']); ?>
        <?php echo CHtml::activeTextField($model, 'name', ['required']); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::activeLabel($model, 'email', ['class' => 'control-label']); ?>
        <?php echo CHtml::activeTextField($model, 'email', ['required']); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::activeLabel($model, 'company_id', ['class' => 'control-label']); ?>
        <?php echo CHtml::dropDownList('company_id', $model->company_id ? $model->company_id : '', $companies); ?>
    </div>

    <div class="form-group">
        <?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

<?php echo CHtml::endForm(); ?>