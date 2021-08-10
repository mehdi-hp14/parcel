<?php

namespace Kaban\General\Services\Media;


use Illuminate\Filesystem\Filesystem;

class Uploader
{
    protected $path;

    protected $name;

    protected $driver;

    protected $disk;

    protected $configKey;

    public function __construct($configKey = '')
    {
        $this->disk = config('eshow.DEFAULT_UPLOADER_DISK', 'sftp');

        $this->driver = app('filesystem')->disk($this->disk);

        $this->configKey = $configKey;
    }

    public function upload(MediaFile $file)
    {
        $fullPath = $file->getFullPath();

        $processor = new ImageProcessor($file, $this->configKey);

        return $this->driver->put($fullPath, $processor->processImage());
    }

    public function uploadThumbnail(MediaFile $file)
    {
        $fullPath = $file->getFullThumbnailPath();

        $processor = new ImageProcessor($file);

        return $this->driver->put($fullPath, $processor->processThumbnail());
    }

    public function setDisk($disk)
    {
        $this->disk = $disk;

        $this->driver = app('filesystem')->disk($this->disk);

        return $this;
    }

    public function getDisk()
    {
        return $this->disk;
    }

    public function setConfigKey($configKey = '')
    {
        $this->configKey = $configKey;

        return $this;
    }
}
