<?php


namespace ityakutia\blog\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;


class ArticleSearch extends Article
{
    public $word;
    public $category_id;
    
    public function rules()
    {
        return [
            [['id', 'is_publish', 'status', 'created_at', 'updated_at', 'category_id'], 'integer'],
            [['title', 'content', 'photo', 'video', 'word'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return parent::attributeLabels() + [
            'word' => 'Поиск',
            'category_id' => 'Категория новостей',
        ];
    }

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
        $query = Article::find();

        $query->joinWith(['articleCategorySets']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'article.id' => $this->id,
            'is_publish' => $this->is_publish,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'article_category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }


    public function searchFront($params, $filter_category_id)
    {
        $query = Article::find();

        $query->joinWith(['articleCategorySets', 'articleCategorySets.articleCategory']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'article.id' => $this->id,
            'article.is_publish' => true,
            'article_category.is_publish' => true,
            'article.created_at' => $this->created_at,
            'article.updated_at' => $this->updated_at,
            'article_category_id' => $this->category_id,
        ]);

        if( $filter_category_id != null )
            $query->andFilterWhere(['like', 'article_category_set.article_category_id', $filter_category_id]);

        $query->andFilterWhere(['like', 'article.title', $this->word])
            ->orFilterWhere(['like', 'article.content', $this->word]);

        return $dataProvider;
    }
}
