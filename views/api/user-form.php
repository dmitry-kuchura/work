<?php

/* @var $model Users */
/* @var $companies [] */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'user-form',
    'htmlOptions' => [
        'class' => 'form-ajax',
    ],
    'enableClientValidation' => true,
    'clientOptions' => [
        'validateOnSubmit' => true,
    ],
]); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', ['class' => 'control-label']); ?>
        <?php echo $form->textField($model, 'name', ['class' => 'form-control']); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email', ['class' => 'control-label']); ?>
        <?php echo $form->textField($model, 'email', ['class' => 'form-control']); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'company_id', ['class' => 'control-label']); ?>
        <?php echo $form->dropDownList($model, 'company_id', $companies, ['class' => 'form-control']); ?>
        <?php echo $form->error($model, 'company_id'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']); ?>
    </div>

<?php $this->endWidget(); ?>