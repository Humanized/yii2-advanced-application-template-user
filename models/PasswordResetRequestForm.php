<?php

namespace humanized\user\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{

    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {

        $identityClass = Yii::$app->user->identityClass;
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => $identityClass,
                'filter' => ['status' => $identityClass::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        $identityClass = \Yii::$app->user->identityClass;
        /* @var $user User */
        $user = $identityClass::findOne([
                    //  'status' => $identityClass::STATUS_ACTIVE,
                    'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!$identityClass::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }

        if (!$user->save()) {
            return false;
        }

        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => '@vendor/humanized/yii2-advanced-application-template-user/mail/passwordResetToken-html', 'text' => '@vendor/humanized/yii2-advanced-application-template-user/mail/passwordResetToken-text'], ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject('Password ' . ($user->status != 0 ? 're' : '') . 'set for ' . Yii::$app->name)
                        ->send();
    }

}
