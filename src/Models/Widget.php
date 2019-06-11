<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;
use Grafite\Cms\Traits\Translatable;

/**
 * @property int id
 */
class Widget extends CmsModel
{
    use Translatable;

    public $table = 'widgets';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'name',
        'slug',
        'content',
    ];

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
}
