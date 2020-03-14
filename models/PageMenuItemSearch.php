<?php


namespace blog\models;


use uraankhayayaal\page\models\PageMenuItem as BasePage;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class PageMenuItemSearch extends BasePage
{
    public function rules(): array
    {
        return [
            [['id', 'user_id', 'page_menu_id', 'page_id', 'sort', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'safe'],
        ];
    }


    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @param $page_menu_id
     * @return ActiveDataProvider
     */
    public function search($params, $page_menu_id): ActiveDataProvider
    {
        $query = PageMenuItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['sort'=>SORT_ASC]],
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
            'user_id' => $this->user_id,
            'page_menu_id' => $page_menu_id,
            'page_id' => $this->page_id,
            'sort' => $this->sort,
            'is_publish' => $this->is_publish,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

