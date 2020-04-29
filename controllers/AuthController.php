<?php

namespace app\controllers;

use app\models\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Yii;
use yii\helpers\Console;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;
use yii\web\UnauthorizedHttpException;

class AuthController extends \yii\web\Controller
{

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => [
                        'http://localhost:4200',
                        'http://localhost:8100',
                        'http://wanna-fresh.ru',
                        'http://app.wanna-fresh.ru',
                    ],
                    'Access-Control-Allow-Origin' => true,
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Request-Method' => ['POST'],
                    'Access-Control-Allow-Headers' => ['Origin', 'Content-Type', 'X-Auth-Token', 'Authorization', 'ngAuthorization', 'x-compress', 'Conf-Auth']
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $login = Yii::$app->request->post('login');
        $password = Yii::$app->request->post('password');
        if ($user = User::findOne(['login' => $login, 'blocked' => 0])) {
            if (Yii::$app->security->validatePassword($password, $user->password_hash)) {
                return Json::encode([
                    'access' => $this->getAccessToken($user),
                    'refresh' => $this->getRefreshToken($user),
                    'user' => [
                        'id' => $user->id,
                        'role' => $user->role_id,
                        'login' => $user->login,
                        'personId' => $user->person ? $user->person->id : '',
                        'personName' => $user->person ? $user->person->name : '',
                        'personName2' => $user->person ? $user->person->name_2 : '',
                        'personSurname' => $user->person ? $user->person->surname : '',
                    ]
                ]);
            }
        }
        return Json::encode(false);
    }

    public function actionRefreshing()
    {
        $refresh = Yii::$app->request->post('refreshToken');
        $token = (new Parser())
            ->parse($refresh);
        $user_id = $token->getClaim('id');
        if ($user = User::findOne(['id' => $user_id, 'blocked' => 0])) {
            $validation_data = new ValidationData();
            if ($token->validate($validation_data)) {
                return Json::encode([
                    'access' => $this->getAccessToken($user),
                    'refresh' => $this->getRefreshToken($user)
                ]);
            } else {
                throw new ForbiddenHttpException();
            }
        }
    }

    private function getAccessToken(User $user)
    {
        $time = time();
        $token = (new Builder())
            ->issuedAt($time)
            ->withClaim('id', $user->id)
            ->expiresAt($time + 180) // 3 minutes
            ->getToken();
        return $token->__toString();
    }

    private function getRefreshToken(User $user)
    {
        $time = time();
        $token = (new Builder())
            ->issuedAt($time)
            ->withClaim('id', $user->id)
            ->expiresAt($time + 86400) // 1 day 86400
            ->getToken();
        return $token->__toString();
    }
}
