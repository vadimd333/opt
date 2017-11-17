<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Autodial;

/**
 * AutodialSearch represents the model behind the search form of `app\models\Autodial`.
 */
class AutodialSearch extends Autodial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'wait_que', 'duration', 'billsec', 'cl_online', 'cur_state','list', 'num_att'], 'integer'],
            [['src', 'dst', 'clid', 'disposition', 'operator', 'record', 'uniqueid', 'last_att', 'type', 'call_date', 'add_date'], 'safe'],
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
        $query = Autodial::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'wait_que' => $this->wait_que,
            'duration' => $this->duration,
            'billsec' => $this->billsec,
            'cl_online' => $this->cl_online,
            'cur_state' => $this->cur_state,
            'num_att' => $this->num_att,
            'last_att' => $this->last_att,
            'call_date' => $this->call_date,
            'add_date' => $this->add_date,
        ]);

        $query->andFilterWhere(['like', 'src', $this->src])
            ->andFilterWhere(['like', 'dst', $this->dst])
            ->andFilterWhere(['like', 'clid', $this->clid])
            ->andFilterWhere(['like', 'disposition', $this->disposition])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'record', $this->record])
            ->andFilterWhere(['like', 'uniqueid', $this->uniqueid])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'list', $this->list]);

        return $dataProvider;
    }
}
