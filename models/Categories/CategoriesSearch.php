<?php

namespace app\models\Categories;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categories\Categories;

/**
 * CategoriesSearch represents the model behind the search form of `app\models\Categories\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['name_ar', 'name_en', 'slug', 'image', 'meta_tag_ar', 'meta_tag_en', 'meta_desc_ar', 'meta_desc_en', 'created_at', 'updated_at'], 'safe'],
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
        $query = Categories::find();

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
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name_ar', $this->name_ar])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'meta_tag_ar', $this->meta_tag_ar])
            ->andFilterWhere(['like', 'meta_tag_en', $this->meta_tag_en])
            ->andFilterWhere(['like', 'meta_desc_ar', $this->meta_desc_ar])
            ->andFilterWhere(['like', 'meta_desc_en', $this->meta_desc_en]);

        return $dataProvider;
    }
}
