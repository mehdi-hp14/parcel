<?php

namespace Kaban\Core\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MixBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('mix', function ($expression) {
            list($type, $asset, $manifest) = explode(',', $expression);

            $trim = ' / \\ \'';

            $asset = trim($asset, $trim);

            $manifest = trim($manifest, $trim);

            $type = trim($type, $trim);

            return $this->renderAsset($type, mix($asset, $manifest));
        });
    }

    public function renderAsset($type, $url)
    {
        switch ($type) {
            case 'css':
                return "<link rel='stylesheet' type='text/css' href='{$url}'/>";
            case 'js':
                return "<script src='{$url}'></script>";
        }

        // return exact url if asset type is not defined
        return $url;
    }
}
