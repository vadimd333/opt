<?php
/**
 * Дополнительные методы форматирования
 */

namespace common\components;

use yii\helpers\Html;

class Formatter extends \yii\i18n\Formatter
{

    public function asPhone($value, $options = [])
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $formatted_value = '+' . $value;
        return Html::a(Html::encode($formatted_value), 'tel:' . $value, $options);
    }

    public function asSlack($value, $options = [])
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $formatted_value = $value;
        return Html::a(Html::encode($formatted_value), 'https://medbooking.slack.com/messages/' . $value, $options);
    }

    public function asSkype($value, $options = [])
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $formatted_value = $value;
        return Html::a(Html::encode($formatted_value), 'callto:' . $value, $options);
    }

    public function asHundreds($value, $options = [])
    {
        return static::asDecimal($value / 100, 2);
    }

    public function asShortTime($value)
    {
        return $this->asTime($value, 'php:i:s');
    }

    public function asJoin($value)
    {
        if (is_array($value)) {
            return join(', ', $value);
        } else {
            return $value;
        }
    }

    public function asListen($value)
    {
        if (is_null($value)) {
            return null;
        }
        return $value ? 'Прослушано' : 'Не прослушано';
    }

    public function asGender($value)
    {
        return $value ? 'Муж.' : 'Жен.';
    }
}