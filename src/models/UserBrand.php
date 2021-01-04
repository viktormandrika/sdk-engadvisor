<?php


namespace engadvisor\sdk\models;
/**
 * Class BranchService
 * @package engadvisor\sdk\models
 * @property int $id [int(11)]
 * @property int $branch_id
 * @property int $brand_id
 *
 * @property-read Brand $brand
 * @property-read Branch $branch
 */
class UserBrand extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            ['user_id', 'integer'],
            ['user_id', 'required'],
            ['brand_id', 'integer'],
            ['brand_id', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_brand';
    }


    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}