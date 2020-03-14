<?php


namespace blog\models;


use uraankhayayaal\page\models\PageMenu as BasePage;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;


class PageMenu extends BasePage
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['is_publish', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'is_publish' => 'Опубликован',
            'status' => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPageMenuItems()
    {
        return $this->hasMany(PageMenuItem::class, ['page_menu_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }
}
