<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;

/**
 * @property mixed tags
 */
class File extends CmsModel
{
    public $table = 'files';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'location' => 'required',
    ];

    protected $fillable = [
        'name',
        'location',
        'user',
        'tags',
        'details',
        'mime',
        'size',
        'is_published',
        'order',
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getTags() : array
    {
        if (!array_key_exists('tags', $this->attributes) || null === $this->attributes['tags']) {
            return [];
        }
        return explode(',', $this->tags);
    }
}
