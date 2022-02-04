<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Recetas;

/**
 * RecetasSearch represents the model behind the search form of `app\models\Recetas`.
 */
class RecetasSearch extends Recetas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_usuario', 'id_prodp', 'comensales'], 'integer'],
            [['tipo', 'fecha', 'estado', 'imagen', 'titulo', 'tiempo', 'dificultad', 'ingredientes', 'pasos'], 'safe'],
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
        $query = Recetas::find();

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
            'id_usuario' => $this->id_usuario,
            'fecha' => $this->fecha,
            'id_prodp' => $this->id_prodp,
            'comensales' => $this->comensales,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'imagen', $this->imagen])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'tiempo', $this->tiempo])
            ->andFilterWhere(['like', 'dificultad', $this->dificultad])
            ->andFilterWhere(['like', 'ingredientes', $this->ingredientes])
            ->andFilterWhere(['like', 'pasos', $this->pasos]);

        return $dataProvider;
    }
}
