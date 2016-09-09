<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
//TODO: bugfix
/* @var $user common\models\User */
//TODO: Remove hardcode
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/default/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Dear Pulsar Client</p>

    <p>Follow the link below to <?= $user->status != 0 ? 're' : '' ?>set your password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
