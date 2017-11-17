<?php

use yii\db\Migration;

class m130524_201442_role extends Migration
{
    public function up()
    {
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Админ';
        Yii::$app->authManager->add($role);

        $role = Yii::$app->authManager->createRole('user');
        $role->description = 'Юзер';
        Yii::$app->authManager->add($role);
    }

    public function down()
    {

    }
}
