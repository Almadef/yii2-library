<?php

namespace common\models\book;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Book;

/**
 * Search represents the model behind the search form of `common\models\Book`.
 */
class Search extends Book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'publisher_id', 'pages', 'created_at', 'updated_at'], 'integer'],
            [['title_ru', 'title_en', 'release', 'isbn', 'description_ru', 'description_en'], 'safe'],
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
        $query = Book::find()
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
            'publisher_id' => $this->publisher_id,
            'release' => $this->release,
            'pages' => $this->pages,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'isbn', $this->isbn]);

        $query->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru]);

        $query->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'description_en', $this->description_en]);

        return $dataProvider;
    }
}
