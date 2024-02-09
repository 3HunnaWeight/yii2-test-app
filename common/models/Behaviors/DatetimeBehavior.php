<?php

namespace common\models\Behaviors;

use Yii;
use yii\base\Behavior;

class DatetimeBehavior extends Behavior
{
    public static function generateDateTime()
    {
        Yii::$app->formatter->timeZone = 'Europe/Moscow';

        return Yii::$app->formatter->asDatetime(time());
    }
}
