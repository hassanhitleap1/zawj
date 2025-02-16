<?php

namespace app\models\user;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\user\User;

/**
 * UserSearch represents the model behind the search form of `app\models\user\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone_number', 'second_phone', 'residence_country_id', 'residence_city_id', 'origin_country_id', 'origin_city_id', 'has_children', 'children_count', 'status', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'email', 'date_of_birth', 'gender', 'hijab_status', 'religion', 'marriage_preference', 'marital_status', 'education_level', 'profession', 'skin_color', 'password_hash', 'auth_key', 'religious_commitment', 'communication_preference'], 'safe'],
            [['height', 'weight'], 'number'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'phone_number' => $this->phone_number,
            'second_phone' => $this->second_phone,
            'date_of_birth' => $this->date_of_birth,
            'height' => $this->height,
            'weight' => $this->weight,
            'residence_country_id' => $this->residence_country_id,
            'residence_city_id' => $this->residence_city_id,
            'origin_country_id' => $this->origin_country_id,
            'origin_city_id' => $this->origin_city_id,
            'has_children' => $this->has_children,
            'children_count' => $this->children_count,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'hijab_status', $this->hijab_status])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'marriage_preference', $this->marriage_preference])
            ->andFilterWhere(['like', 'marital_status', $this->marital_status])
            ->andFilterWhere(['like', 'education_level', $this->education_level])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'skin_color', $this->skin_color])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'religious_commitment', $this->religious_commitment])
            ->andFilterWhere(['like', 'communication_preference', $this->communication_preference]);

        return $dataProvider;
    }
}
