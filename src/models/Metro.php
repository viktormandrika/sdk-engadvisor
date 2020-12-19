<?php

namespace engadvizor\models;

use Yii;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property float $lat [double]
 * @property int $hh_id
 * @property int $line_id [int(11)]
 * @property float $lng [double]
 * @property int $order_num [int(11)]
 * @property MetroLine $line


 */
class Metro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_metro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['lat', 'lng'], 'double'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['hh_id'], 'integer'],
            [['line_id'], 'exist', 'skipOnError' => true, 'targetClass' => MetroLine::className(), 'targetAttribute' => ['line_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'lat' => 'Latitude',
            'lng' => 'Longitude',
            'hh_id' => 'Longitude',
            'line_id' => 'Line ID',
        ];
    }


    public function getLine(){
        return $this->hasOne(MetroLine::class, ['id' => 'line_id']);
    }
}
