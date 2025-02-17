<?php

namespace app\models\Pages;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pages\Pages;

/**
 * PagesSearch represents the model behind the search form of `app\models\Pages\Pages`.
 */
class PagesSearch extends Pages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['key', 'title_ar', 'title_en', 'desc_ar', 'desc_en', 'meta_tag_ar', 'meta_tag_en', 'meta_desc_ar', 'meta_desc_en', 'created_at', 'updated_at'], 'safe'],
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
        $query = Pages::find();

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

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'title_ar', $this->title_ar])
            ->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'desc_ar', $this->desc_ar])
            ->andFilterWhere(['like', 'desc_en', $this->desc_en])
            ->andFilterWhere(['like', 'meta_tag_ar', $this->meta_tag_ar])
            ->andFilterWhere(['like', 'meta_tag_en', $this->meta_tag_en])
            ->andFilterWhere(['like', 'meta_desc_ar', $this->meta_desc_ar])
            ->andFilterWhere(['like', 'meta_desc_en', $this->meta_desc_en]);

        return $dataProvider;
    }
}
