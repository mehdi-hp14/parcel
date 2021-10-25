<?php

namespace Kaban\General\Services\Media;


use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;

class ImageProcessor
{
    protected $file;

    protected $config;

    protected $thumbnail;

    public function __construct($file, $configKey = '')
    {
        $this->file = $file;

        $this->config = $this->loadConfig($configKey);
    }

    public function processImage()
    {
        $resizeMode = $this->config('resize_mode');

        $image = $this->file->getFile();

        //TODO implement Crop and Fit
        switch ($resizeMode) {
            case 'center':
                $frontImage = $image;

                $frontImage->resize($this->config('width'), $this->config('height'), function ($constraint) {
                    // constrain aspect ratio
                    if ($this->config('ratio')) {
                        $constraint->aspectRatio();
                    }
                    // prevent possible upsizing
                    if ($this->config('upsize')) {
                        $constraint->upsize();
                    }
                });

                $image = Image::canvas($this->config('width'), $this->config('height'), '000000');

                $image->insert($frontImage, 'center');

                break;
            default:

                // Resize image
                if ($this->config('width') || $this->config('height')) {
                    $image = $image->resize($this->config('width'), $this->config('height'), function ($constraint) {
                        // constrain aspect ratio
                        if ($this->config('ratio')) {
                            $constraint->aspectRatio();
                        }
                        // prevent possible upsizing
                        if ($this->config('upsize')) {
                            $constraint->upsize();
                        }
                    });
                }
        }


        // Add Image Watermark
//        if ($watermarkImage = $this->config('watermark_image', false)) {
//            $image = $image->insert($watermarkImage, $this->config('watermark_position'), $this->config('watermark_offset_x'), $this->config('watermark_offset_y'));
//        }
//
//        // Add Image Watermark
//        if ($watermarkText = $this->config('watermark_text', false)) {
//            $image = $image->text($watermarkText, $this->config('watermark_offset_x'), $this->config('watermark_offset_y'));
//        }

        return $image->encode(null, $this->config('quality'));
    }

    public function processThumbnail()
    {
        $thumbnailResizeMode = $this->config('thumbnail.resize_mode');

        $image = $this->file->getFile();

        //TODO implement Crop and Fit
        switch ($thumbnailResizeMode) {
            case 'center':
                $frontImage = $image;

                $frontImage->resize($this->config('thumbnail.width'), $this->config('thumbnail.height'), function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $image = Image::canvas($this->config('thumbnail.width'), $this->config('thumbnail.height'), '000000');

                $image->insert($frontImage, 'center');

                break;
            default:

                // Resize image thumbnail
                $image = $image->resize($this->config('thumbnail.width'), $this->config('thumbnail.height'), function ($constraint) {
                    $constraint->upsize();
                });
        }

        return $image->encode(null, $this->config('thumbnail.quality'));
    }

    public function config($key, $default = '')
    {
        return Arr::get($this->config, $key, $default);
    }

    private function loadConfig($configKey)
    {
        $defaultConfig = config('media.default');

        $customConfig = [];

        if (\Auth::check()) {
            if ($customConfig = config('media.' . $configKey)) {
                $customConfig = array_merge(Arr::get($customConfig, "default", []), Arr::get($customConfig, \Auth::user()->panel_name, []));
            } else {
                $customConfig = config('media.' . \Auth::user()->panel_name, []);
            }
        }

        return array_merge($defaultConfig, $customConfig);
    }

}
