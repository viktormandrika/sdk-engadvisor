<?php

namespace eengadvisor\sdk\models;

use Yii;

/**
 * This is the model class for table "geo_country".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @property City[] $cities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Title',
            'slug' => 'Slug',
        ];
    }

    public function getRegions()
    {
        return $this->hasMany(Region::class, ['country_id' => 'id']);
    }
}
