<?php

namespace engadvisor\sdk\models;

use Yii;

/**
 * @property int $id
 * @property string $hex_color
 * @property string $name
 * @property int $city_id
 * @property int $hh_id
 *
 * @property City $city
 */
class MetroLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_metro_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hex_color', 'name', 'city_id'], 'required'],
            [['city_id', 'hh_id'], 'integer'],
            [['hex_color', 'name'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hex_color' => 'Hex Color',
            'name' => 'Name',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getMetro()
    {
        return $this->hasMany(Metro::class, ['line_id' => 'id']);
    }
}
