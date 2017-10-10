<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<div class="profile">
    <div class="tabbable-line tabbable-full-width">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#users" data-toggle="tab" aria-expanded="true"> Users </a>
            </li>
            <li class="">
                <a href="#companies" data-toggle="tab" aria-expanded="false"> Companies </a>
            </li>
            <li class="">
                <a href="#abusers" data-toggle="tab" aria-expanded="false"> Abusers </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="users">
                <div class="row">
                    <?php $this->widget('application.components.UsersWidget'); ?>
                </div>
            </div>
            <div class="tab-pane" id="companies">
                <div class="row">
                    <?php $this->widget('application.components.CompaniesWidget'); ?>
                </div>
            </div>
            <div class="tab-pane" id="abusers">
                <div class="row">
                    <?php $this->widget('application.components.TransferLogsWidget'); ?>
                </div>
            </div>
        </div>
    </div>
</div>