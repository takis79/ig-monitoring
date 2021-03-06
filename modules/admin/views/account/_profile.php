<?php

use jakim\ig\Url;
use yii\helpers\Html;
use app\modules\admin\widgets\InvalidAccountAlert;
use app\modules\admin\widgets\OnOffMonitoringButton;
use app\modules\admin\widgets\favorites\ProfileButton;
use app\modules\admin\widgets\TagsSideWidget;
use app\modules\admin\widgets\NotesSideWidget;


/* @var $this yii\web\View */
/* @var $model app\models\Account */

$formatter = Yii::$app->formatter;
$lastAccountStats = $model->lastAccountStats;

?>
<?php if (!$model->is_valid): ?>
    <?= InvalidAccountAlert::widget([
        'model' => $model,
    ]) ?>
<?php endif; ?>

<div class="box box-primary">


    <div class="box-body box-profile">
        <?php if ($model->profile_pic_url): ?>
            <?= Html::img($model->profile_pic_url, ['class' => 'profile-user-img img-responsive img-circle']) ?>
        <?php endif; ?>
        <h3 class="profile-username text-center">
            <?= Html::encode($model->displayName) ?>
            <?= Html::a('<span class="fa fa-external-link text-sm"></span>', Url::account($model->username), ['target' => '_blank']) ?>
        </h3>
        <p class="text-muted text-center">
            <?php if ($model->name): ?>
                <?= Html::encode($model->usernamePrefixed) ?><br>
            <?php endif; ?>
            <?= Html::encode($model->full_name) ?>
        </p>
        <?php if ($lastAccountStats): ?>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('followed_by') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asInteger($lastAccountStats->followed_by) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('follows') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asInteger($lastAccountStats->follows) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('media') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asInteger($lastAccountStats->media) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $lastAccountStats->getAttributeLabel('er') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asPercent($lastAccountStats->er, 2) ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <b><?= $model->getAttributeLabel('updated_at') ?></b>
                    <a class="pull-right">
                        <?= $formatter->asDatetime($lastAccountStats->created_at) ?>
                    </a>
                </li>
            </ul>
        <?php endif; ?>
        <?= OnOffMonitoringButton::widget([
            'model' => $model,
        ]) ?>

        <?= ProfileButton::widget([
            'model' => $model,
        ]) ?>
        <?= Html::a('<span class="fa fa-external-link"></span> Public url', ['/preview/account', 'uid' => $model->uid], ['class' => 'btn btn-default btn-block btn-sm', 'target' => '_blank']) ?>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Description</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php if ($model->external_url): ?>
            <strong><i class="fa fa-external-link margin-r-5"></i>
                <?= $model->getAttributeLabel('external_url') ?>
            </strong>
            <p class="text-muted">
                <?= Html::a($model->external_url, $model->external_url, ['target' => '_blank']) ?>
            </p>
            <hr>
        <?php endif; ?>
        <?php if ($model->biography): ?>
            <strong><i class="fa fa-book margin-r-5"></i>
                <?= $model->getAttributeLabel('biography') ?>
            </strong>
            <p class="text-muted">
                <?= $formatter->asNtext($model->biography) ?>
            </p>
            <hr>
        <?php endif; ?>

        <?= TagsSideWidget::widget([
            'model' => $model,
        ]); ?>
        <hr>
        <?= NotesSideWidget::widget([
            'model' => $model,
        ]); ?>
    </div>
    <!-- /.box-body -->
</div>