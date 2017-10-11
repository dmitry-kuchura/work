<?php

/* @var $model Users */
/* @var $companies [] */
?>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'contact-form',
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
        <?php echo $form->labelEx($model, 'quota', ['class' => 'control-label']); ?>
        <?php echo $form->textField($model, 'quota', ['class' => 'form-control', 'value' => (int)Helper::fileSizeConvert($model['quota'])]); ?>
        <?php echo $form->error($model, 'quota'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'quota_type', ['class' => 'control-label']); ?>
        <?php echo $form->dropDownList($model, 'quota_type', $types, ['class' => 'form-control']); ?>
        <?php echo $form->error($model, 'quota_type'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']); ?>
    </div>

<?php $this->endWidget(); ?>