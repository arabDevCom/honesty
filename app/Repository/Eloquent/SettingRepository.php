<?php

namespace App\Repository\Eloquent;

use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

//class SettingRepository extends Repository implements SettingRepositoryInterface // Update this line
class SettingRepository extends Repository implements SettingRepositoryInterface // Update this line

{
    protected Model $model;

    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getActiveUsers()
    {
        return $this->model::query()->where('is_active', true);
    }


}
