<?php

namespace engadvisor\sdk\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property float|null $lng
 * @property float|null $lat
 * @property string|null $slug
 * @property int $city_id
 * @property int|null $metro_id
 * @property int|null $branch_id
 *
 * @property City $city
 * @property Metro $metro
 * @property Branch[] $branch
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address', 'city_id'], 'required'],
            [['title', 'address'], 'string'],
            [['lng', 'lat'], 'number'],
            [['city_id', 'metro_id'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['metro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metro::class, 'targetAttribute' => ['metro_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'address' => 'Адрес',
            'lon' => 'Lon',
            'lat' => 'Lat',
            'slug' => 'URL',
            'city_id' => 'Город',
            'metro_id' => 'Метро',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Metro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetro()
    {
        return $this->hasOne(Metro::class, ['id' => 'metro_id']);
    }

    /**
     * Gets query for [[Branches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }
}
