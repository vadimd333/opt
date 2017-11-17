<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "cdr".
 *
 * @property int $id
 * @property string $accountcode
 * @property string $src
 * @property string $dst
 * @property string $did
 * @property string $dcontext
 * @property string $clid
 * @property string $channel
 * @property string $dstchannel
 * @property string $lastapp
 * @property string $lastdata
 * @property string $start
 * @property string $answer
 * @property string $end
 * @property int $duration
 * @property int $billsec
 * @property int $press
 * @property string $disposition
 * @property string $op_answer
 * @property string $operator
 * @property int $wait_duration
 * @property int $ans_duration
 * @property string $amaflags
 * @property string $userfield
 * @property string $uniqueid
 * @property string $linkedid
 * @property string $tr_linkedid
 * @property string $peeraccount
 * @property string $direct
 * @property int $sequence
 * @property string $mark
 */
class Cdr extends \yii\db\ActiveRecord
{
    public static $directDetailNames = [
        0 => 'Клиент => КЦ',
        1 => 'Клиент => Магазин',
        2 => 'КЦ => Магазин',
        3 => 'КЦ => Клиент',
        4 => 'КЦ (Оператор) => Клиент / Магазин',
        5 => 'КЦ (Автодозвон) => Клиент / Магазин',
    ];
//    public $direct_detail_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cdr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'answer', 'end'], 'safe'],
            [['duration', 'billsec', 'wait_duration', 'sequence'], 'integer'],
            [['accountcode', 'peeraccount'], 'string', 'max' => 20],
            [['src', 'dst', 'did', 'dcontext', 'clid', 'channel', 'dstchannel', 'lastapp', 'lastdata'], 'string', 'max' => 80],
            [['disposition', 'op_answer', 'amaflags'], 'string', 'max' => 45],
            [['operator'], 'string', 'max' => 40],
            [['press'], 'boolean',],
            [['userfield'], 'string', 'max' => 256],
            [['uniqueid', 'linkedid'], 'string', 'max' => 150],
            [['direct', 'mark'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accountcode' => 'Accountcode',
            'src' => 'Кто',
            'dst' => 'Куда',
            'did' => 'Did',
            'dcontext' => 'Dcontext',
            'clid' => 'Clid',
            'channel' => 'Channel',
            'dstchannel' => 'Dstchannel',
            'lastapp' => 'Lastapp',
            'lastdata' => 'Lastdata',
            'start' => 'Время',
            'answer' => 'Answer',
            'end' => 'End',
            'duration' => 'Длит. вызова',
            'billsec' => 'Billsec',
            'disposition' => 'Disposition',
            'op_answer' => 'Статус',
            'operator' => 'Оператор',
            'ans_duration' => 'Длит. разговора',
            'amaflags' => 'Amaflags',
            'userfield' => 'Запись',
            'uniqueid' => 'Uniqueid',
            'linkedid' => 'Linkedid',
            'peeraccount' => 'Peeraccount',
            'direct' => 'Направление',
            'sequence' => 'Sequence',
            'press'=>'Нажато',
            'direct_detail_name'=>'Детализация звонка'
        ];
    }
    public function getUrl($action, $asString = false)
    {
        $url = [];
        if ($action == "download") {
            $url = ['pami-client/download', 'f' => $this->getFile()];
        } elseif ($action == "play") {
            $url = '#';
        }
        return $asString ? Url::to($url) : $url;
    }

    public function getDirect_detail_id (){
        $sql = "select CASE
    WHEN direct = 'REDIR' THEN 1
    WHEN direct = 'IN' AND CHAR_LENGTH(operator) > 3 THEN 0
    WHEN direct = 'OUT' AND accountcode = 'autoreg' THEN 2
    WHEN direct = 'OUT' AND accountcode = 'askingcl' THEN 3
    WHEN direct = 'OUT' AND accountcode = 'medbooking' THEN 4
    WHEN direct = 'OUT' AND operator = 'outsource' THEN 5
    ELSE null
END
from cdr where id = ".$this->id;
        return Yii::$app->db->createCommand($sql)->queryScalar();
    }

    public function getFile()
    {
        preg_match('/\d+-\d+-\d+/',$this->userfield,$matches);
        return $matches?'/files'.\Yii::$app->formatter->asDate(current($matches), 'php:/Y/m/d/') . $this->userfield . ".mp3":'';
    }
    public function getDirect_detail_name()
    {
        return ArrayHelper::getValue(self::$directDetailNames, $this->direct_detail_id, 'Неизвестно');
    }
}
