<?php

namespace engadvizor\models;

use Yii;

/**
 * This is the model class for table "geo_city".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property integer $region_id
 * @property integer $hh_id
 *
 * @property Region $region
 * @property Metro[] $Metro
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'region_id'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'URL',
            'region_id' => 'Регион',
        ];
    }


    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getMetroLines()
    {
        return $this->hasMany(MetroLine::class, ['city_id' => 'id']);
    }

}
