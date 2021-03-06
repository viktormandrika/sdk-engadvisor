<?php

namespace engadvisor\sdk\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property int $brand_id
 * @property string $name
 * @property int $meta_id [int(11)]
 *
 * @property Address $address
 * @property Brand $brand
 * @property Meta $meta
 * @property Service[] $services
 * @property-read BranchService[] $branchServices
 */
class Branch extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['brand_id', 'required'],
            ['brand_id', 'integer'],
            [['brand_id', 'meta_id'], 'integer'],
            ['name', 'string'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['brand_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_id' => 'ID бренда',
            'address_id' => 'ID адреса',
            'name' => 'Внутреннее название филлиала',
            'brand' => 'К какому бренду относится'
        ];
    }

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::class, ['branch_id' => 'id']);
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getBranchServices()
    {
        return $this->hasMany(BranchService::class, ['branch_id' => 'id']);

    }

    public function getServices()
    {
        return $this->hasMany(Service::class, ['id' => 'service_id'])->via('branchServices');
    }

    public function getMeta()
    {
        return $this->hasOne(Meta::class, ['id' => 'meta_id']);
    }
}
