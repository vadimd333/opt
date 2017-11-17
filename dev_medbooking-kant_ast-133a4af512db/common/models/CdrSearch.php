<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cdr;
use yii\helpers\VarDumper;

/**
 * CdrSearch represents the model behind the search form of `common\models\Cdr`.
 */
class CdrSearch extends Cdr
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'duration', 'billsec','press', 'ans_duration', 'sequence'], 'integer'],
            [['accountcode', 'src', 'dst', 'did', 'dcontext', 'clid', 'channel', 'dstchannel', 'lastapp', 'lastdata', 'start', 'answer', 'end', 'disposition', 'op_answer', 'operator', 'amaflags', 'userfield', 'uniqueid', 'linkedid', 'peeraccount', 'direct', 'mark'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Cdr::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (empty($params['sort'])){
         $query->orderBy('start DESC');
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'answer' => $this->answer,
            'end' => $this->end,
            'duration' => $this->duration,
            'press' => $this->press,
            'billsec' => $this->billsec,
            'ans_duration' => $this->ans_duration,
            'sequence' => $this->sequence,
        ]);

        $query->andFilterWhere(['like', 'accountcode', $this->accountcode])
            ->andFilterWhere(['like', 'src', $this->src])
            ->andFilterWhere(['like', 'dst', $this->dst])
            ->andFilterWhere(['like', 'did', $this->did])
            ->andFilterWhere(['like', 'dcontext', $this->dcontext])
            ->andFilterWhere(['like', 'clid', $this->clid])
            ->andFilterWhere(['like', 'channel', $this->channel])
            ->andFilterWhere(['like', 'dstchannel', $this->dstchannel])
            ->andFilterWhere(['like', 'lastapp', $this->lastapp])
            ->andFilterWhere(['like', 'lastdata', $this->lastdata])
            ->andFilterWhere(['like', 'disposition', $this->disposition])
            ->andFilterWhere(['like', 'op_answer', $this->op_answer])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'amaflags', $this->amaflags])
            ->andFilterWhere(['like', 'userfield', $this->userfield])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'uniqueid', $this->uniqueid])
            ->andFilterWhere(['like', 'linkedid', $this->linkedid])
            ->andFilterWhere(['like', 'peeraccount', $this->peeraccount])
            ->andFilterWhere(['like', 'direct', $this->direct])
            ->andFilterWhere(['like', 'mark', $this->mark]);

        return $dataProvider;
    }
}
