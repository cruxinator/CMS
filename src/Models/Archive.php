<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;
use Illuminate\Database\Eloquent\Model;

class Archive extends CmsModel
{
    public $table = 'archives';

    public $primaryKey = 'id';

    public $fillable = [
        'token',
        'updated_by',
        'entity_id',
        'entity_type',
        'entity_data',
    ];

    public static $rules = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updatedBy()
    {
        $userModel = config('cms.user-model');
        /** @var Model|null $userModel */
        $userModel = $userModel ? new $userModel() : null;

        $keyCol = $userModel ? $userModel->getKey() : 'id';

        return $this->belongsTo($userModel, 'updated_by', $keyCol);
    }

    public function getUpdatedEmailAttribute()
    {
        $user = $this->updatedBy;
        if (null === $user) {
            return null;
        }
        return $user->email;
    }
}
