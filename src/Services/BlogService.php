<?php

namespace Grafite\Cms\Services;

use Grafite\Cms\Services\BaseService;
use Illuminate\Support\Facades\Config;

class BlogService extends BaseService
{
    /**
     * Get templates as options
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getTemplatesAsOptions()
    {
        return $this->getTemplatesAsOptionsArray('blog');
    }
}
