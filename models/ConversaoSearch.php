<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Conversao;

/**
 * ConversaoSearch representa o modelo do formulário de pesquisa do `app\models\Conversao`.
 */
class ConversaoSearch extends Conversao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['moedaorigem', 'moedadestino', 'formadepagamento', 'datacriacao'], 'safe'],
            [['valororigem', 'cotacaoatual', 'taxapagamento', 'taxaconversao', 'valorconversao'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Cria instância de DataProvider com consulta de pesquisa aplicada
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Conversao::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'valororigem' => $this->valororigem,
            'cotacaoatual' => $this->cotacaoatual,
            'taxapagamento' => $this->taxapagamento,
            'taxaconversao' => $this->taxaconversao,
            'valorconversao' => $this->valorconversao,
            'datacriacao' => $this->datacriacao,
        ]);

        $query->andFilterWhere(['like', 'moedaorigem', $this->moedaorigem])
            ->andFilterWhere(['like', 'moedadestino', $this->moedadestino])
            ->andFilterWhere(['like', 'formadepagamento', $this->formadepagamento]);

        return $dataProvider;
    }
}
