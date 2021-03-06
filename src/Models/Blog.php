<?php

namespace Grafite\Cms\Models;

use Grafite\Cms\Models\CmsModel;
use Grafite\Cms\Services\Normalizer;
use Grafite\Cms\Traits\Translatable;

/**
 * @property string hero_image
 * @property int id
 * @property mixed tags
 */
class Blog extends CmsModel
{
    use Translatable;

    public $table = 'blogs';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'title',
        'entry',
        'tags',
        'is_published',
        'is_featured',
        'seo_description',
        'seo_keywords',
        'url',
        'template',
        'published_at',
        'hero_image',
        'blocks',
    ];

    protected $dates = [
        'published_at' => 'Y-m-d H:i'
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }

    public function getEntryAttribute($value)
    {
        return new Normalizer($value);
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getHeroImageUrlAttribute()
    {
        $base = 'https://fakeimg.pl/200x200/777777/777777/';

        if ($this->hero_image) {
            return url(str_replace('public/', 'storage/', $this->hero_image));
        }
        return $base;
    }

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }

    public function getBlocksAttribute($value)
    {
        $blocks = json_decode($value, true);

        if (is_null($blocks)) {
            $blocks = [];
        }

        return $blocks;
    }

    public function getTags() : array
    {
        if (!array_key_exists('tags', $this->attributes) || null === $this->attributes['tags']) {
            return [];
        }
        return explode(',', $this->tags);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function scopeUnPublished($query)
    {
        return $query->where('is_published', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeUnFeatured($query)
    {
        return $query->where('is_featured', 0);
    }
}
