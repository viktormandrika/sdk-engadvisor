<?php


namespace engadvisor\sdk\models;
/**
 * Class BranchService
 * @package engadvisor\sdk\models
 * @property int $service_id
 * @property int $price
 * @property int $branch_id
 *
 * @property-read Service $service
 * @property-read Branch $branch
 */
class BranchService extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            ['service_id', 'integer'],
            ['price', 'integer'],
            ['branch_id', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch_service';
    }

    public static function primaryKey()
    {
        return 'service_id';
    }

    public function getServices()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['id' => 'branch_id']);
    }
}