<?php

namespace app\models;

use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "autodial".
 *
 * @property int $id
 * @property string $src
 * @property string $dst
 * @property string $did
 * @property string $clid
 * @property int $wait_que
 * @property int $duration
 * @property int $billsec
 * @property int $list
 * @property string $disposition
 * @property string $operator
 * @property string $record
 * @property string $delimiter
 * @property string $uniqueid
 * @property string $project
 * @property int $cl_online
 * @property int $cur_state
 * @property int $num_att
 * @property string $last_att
 * @property string $type
 * @property string $call_date
 * @property string $add_date
 * @property int $record_id
 */
class Autodial extends \yii\db\ActiveRecord
{
    public $csvFile;
    public $delimiter = ';';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'autodial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['wait_que','duration','last_att', 'billsec', 'cl_online', 'cur_state', 'num_att'], 'required'],
            [['wait_que', 'duration', 'billsec', 'cl_online', 'cur_state', 'num_att','list'], 'integer'],
            [['last_att', 'call_date', 'add_date', 'delimiter'], 'safe'],
            [['src', 'dst', 'clid'], 'string', 'max' => 80],
            [['disposition'], 'string', 'max' => 45],
            [['operator', 'type'], 'string', 'max' => 20],
            [['record'], 'string', 'max' => 256],
            [['uniqueid'], 'string', 'max' => 150],
            [['src', 'dst', 'call_date'], 'unique', 'targetAttribute' => ['src', 'dst', 'call_date']],
            [['csvFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'csv'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Куда',
            'dst' => 'Определяемый номер',
            'clid' => 'Clid',
            'wait_que' => 'Ожидание оператора',
            'duration' => 'Длит. вызова',
            'billsec' => 'Длит. разговора',
            'disposition' => 'Статус',
            'operator' => 'Оператор',
            'record' => 'Запись',
            'uniqueid' => 'Uniqueid',
            'cl_online' => 'Cl Online',
            'cur_state' => 'Cur State',
            'num_att' => 'Кол. попыток',
            'last_att' => 'Последняя попытка',
            'type' => 'Тип',
            'call_date' => 'Call Date',
            'add_date' => 'Дата добавления',
            'list' => 'Лист',
            'delimiter' => 'Разделитель',
        ];
    }
    public function upload()
    {
        $importer = new CSVImporter;
            $this->csvFile->saveAs('uploads/autodial.csv');
        $importer->setData(new CSVReader([
            'filename' => 'uploads/autodial.csv',
            'fgetcsvOptions' => [
                'delimiter' => $this->delimiter
            ]
        ]));

        foreach (current($importer) as $item) {
            $autodial = new Autodial();
            $autodial->src = $item[0];
            $autodial->dst = $item[1];
            $autodial->clid = 'Call_List';
            $autodial->disposition = 'WAIT';
            $autodial->type = 'calllist';
            $autodial->call_date = date('c');
            $autodial->add_date = date('c');
            $autodial->save();
        }
    }
    public function getFile()
    {
        if (!empty($this->record)){
            preg_match('/\d+-\d+-\d+/',$this->record,$matches);
            return '/files'.\Yii::$app->formatter->asDate(current($matches), 'php:/Y/m/d/') . $this->record . ".mp3";
        }
       else{
            return '';
       }

    }
}
