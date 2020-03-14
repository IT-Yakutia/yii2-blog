<?php


namespace blog\models;


use uraankhayayaal\page\models\PageMenuItem as BasePage;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use uraankhayayaal\sortable\behaviors\Sortable;
use uraankhayayaal\page\components\EitherValidator;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


class PageMenuItem extends BasePage
{
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            'sortable' => [
                'class' => Sortable::class,
                'query' => self::find(),
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'user_id',
                ],
                'value' => static function ($event) {
                    return Yii::$app->user->id;
                },
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['name', 'page_menu_id'], 'required'],
            [['user_id', 'page_menu_id', 'page_id', 'sort', 'is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
            [['url'], 'url'],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::class, 'targetAttribute' => ['page_id' => 'id']],
            [['page_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => PageMenu::class, 'targetAttribute' => ['page_menu_id' => 'id']],
            ['page_id', 'unique'],
            [['url', 'page_id'], EitherValidator::class],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'url' => 'Ссылка',
            'user_id' => 'Автор',
            'page_menu_id' => 'Меню',
            'page_id' => 'Страница',
            'sort' => 'Sort',
            'is_publish' => 'Опубликовать',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPage(): ActiveQuery
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPageMenu(): ActiveQuery
    {
        return $this->hasOne(PageMenu::class, ['id' => 'page_menu_id']);
    }
}
