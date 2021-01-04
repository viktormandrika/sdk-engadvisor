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
class BrandBranch extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            ['branch_id', 'integer'],
            ['branch_id', 'required'],
            ['brand_id', 'integer'],
            ['brand_id', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand_branch';
    }

    public static function primaryKey()
    {
        return 'id';
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }
}