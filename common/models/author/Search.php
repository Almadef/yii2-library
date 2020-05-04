<?php

namespace common\models\author;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Author;

/**
 * Search represents the model behind the search form of `common\models\Author`.
 */
class Search extends Author
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name_ru', 'surname_ru', 'patronymic_ru', 'name_en', 'surname_en', 'patronymic_en'], 'safe'],
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
        $query = Author::find()
            ->isNoDeleted();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'surname_ru', $this->surname_ru])
            ->andFilterWhere(['like', 'patronymic_ru', $this->patronymic_ru]);

        $query->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'surname_en', $this->surname_en])
            ->andFilterWhere(['like', 'patronymic_en', $this->patronymic_en]);

        return $dataProvider;
    }
}
