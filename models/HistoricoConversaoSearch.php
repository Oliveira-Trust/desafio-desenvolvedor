<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistoricoConversao;

/**
 * HistoricoConversaoSearch represents the model behind the search form of `app\models\HistoricoConversao`.
 */
class HistoricoConversaoSearch extends HistoricoConversao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['moedaorigem', 'moedadestino', 'formadepagamento', 'datacriacao'], 'safe'],
            [['valororigem', 'valordestino', 'cotacao', 'taxapagamento', 'taxaconversao', 'valorfinal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = HistoricoConversao::find();

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
            'valororigem' => $this->valororigem,
            'valordestino' => $this->valordestino,
            'cotacao' => $this->cotacao,
            'taxapagamento' => $this->taxapagamento,
            'taxaconversao' => $this->taxaconversao,
            'valorfinal' => $this->valorfinal,
            'datacriacao' => $this->datacriacao,
        ]);

        $query->andFilterWhere(['like', 'moedaorigem', $this->moedaorigem])
            ->andFilterWhere(['like', 'moedadestino', $this->moedadestino])
            ->andFilterWhere(['like', 'formadepagamento', $this->formadepagamento]);

        return $dataProvider;
    }
}
