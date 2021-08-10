<?php

namespace Kaban\General\Services\Media;


use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;

class MediaFile
{
    protected $file;

    protected $path;

    protected $name;

    protected $title;

    protected $mimetype;

    protected $thumbnailPath;

    public function __construct($file = null, $path = null, $name = '', $thumbnailPath = null)
    {
        $this->file = $file ? app(ImageManager::class)->make($file) : $file;

        $this->setPath($path);

        $this->setName($name);

        $this->setThumbnailPath($thumbnailPath);
    }

    public function fromUploadedFile(UploadedFile $file)
    {
        $this->setFile($file);

        $this->setName($file->hashName(''));

        $this->setTitle($file->getClientOriginalName());

        $this->setMimetype($file->getMimeType());

        return $this;
    }

    public function fromImageInstance($file)
    {
        $ext = ExtensionGuesser::getInstance()->guess($file->mime());

        $name = str_random(40) . '.' . $ext;

        $this->file = $file;

        $this->setName($name);

        $this->setTitle($name);

        $this->setMimetype($file->mime());

        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getPath()
    {
        return $this->path ?: config('eshow.UPLOAD_BASE_PATH', 'eshow') . '/' . date('Y/m/d');
    }

    public function setThumbnailPath($thumbnailPath)
    {
        $this->thumbnailPath = $thumbnailPath;

        return $this;
    }

    public function getThumbnailPath()
    {
        return $this->thumbnailPath ?: config('eshow.UPLOAD_THUMBNAIL_PATH', 'eshow/thumbnails');
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name ?: $this->name = str_random(60) . '.' . $this->guessExtension();
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFullPath()
    {
        return trim($this->getPath(), '/ \\') . '/' . trim($this->getName(), '/ \\');
    }

    public function getFullThumbnailPath()
    {
        return trim($this->getThumbnailPath(), '/ \\') . '/thumb-' . trim($this->getName(), '/ \\');
    }

    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;

        return $this;
    }

    public function getMimetype()
    {
        return $this->mimetype;
    }

    public function setFile($file)
    {
        $this->file = $file ? app(ImageManager::class)->make($file) : $file;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getEncoded($format = null, $quality = 100)
    {
        return $this->file->encode($format, $quality);
    }

    public function guessExtension()
    {
        $guesser = ExtensionGuesser::getInstance();

        return $guesser->guess($this->getMimetype());
    }
}
