<?php

namespace Grafite\Cms\Controllers;

use Illuminate\Filesystem\Filesystem;
use Grafite\Cms\Services\AssetService;
use Grafite\Cms\Controllers\GrafiteCmsController;

class AssetController extends GrafiteCmsController
{
    public function __construct(AssetService $service)
    {
        parent::construct();

        $this->service = $service;
    }

    /**
     * Provide the File as a Public Asset.
     *
     * @param string $encFileName
     *
     * @return \Grafite\Cms\Services\Download
     */
    public function asPublic($encFileName)
    {
        return $this->service->asPublic($encFileName);
    }

    /**
     * Provide the File as a Public Preview.
     *
     * @param string $encFileName
     *
     * @param Filesystem $fileSystem
     * @return \Grafite\Cms\Services\Download
     */
    public function asPreview($encFileName, Filesystem $fileSystem)
    {
        return $this->service->asPreview($encFileName, $fileSystem);
    }

    /**
     * Provide file as download.
     *
     * @param string $encFileName
     * @param string $encRealFileName
     *
     * @return \Grafite\Cms\Services\Downlaod
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function asDownload($encFileName, $encRealFileName)
    {
        return $this->service->asDownload($encFileName, $encRealFileName);
    }

    /**
     * Gets an asset.
     *
     * @param string $encPath
     * @param string $contentType
     *
     * @param Filesystem $fileSystem
     * @return Provides the valid
     */
    public function asset($encPath, $contentType, Filesystem $fileSystem)
    {
        return $this->service->asset($encPath, $contentType, $fileSystem);
    }
}
