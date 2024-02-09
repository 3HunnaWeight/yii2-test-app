<?php
namespace common\models\Behaviors;

use yii\base\Behavior;

class DatetimeBehavior extends Behavior
{
    public static function generateDateTime()
    {
        return date('Y-m-d H:i:s', time());
    }
}