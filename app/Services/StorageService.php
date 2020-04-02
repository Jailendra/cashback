<?php

namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use App\Factories\ResourceFactory as Factory;
use Illuminate\Http\Request;

class StorageService {

    const DEFAULT_IMAGE_PATH = "no_img.png";

    private $file;
    private $factory;

    public function __construct (Filesystem $file, Factory $factory) {
        $this->file = $file;
        $this->factory = $factory;
    }

    /**
     * Method to store file into storage
     */
    public function saveFile (UploadedFile $file, string $directory):string {
        return $this->file->putFileAs($directory, $file, md5(microtime(true)).'.'.$file->clientExtension());
    }

    /**
     * Metod to store content into file
     */
    public function store (string $path, $content) {
        return $this->file->put ($path, $content);
    }

    /**
     * Method to get respource
     */
    public function retrieveResourcePath (Request $request):string {
        $model = $this->getModelByType ($request->route()->parameter('type'));
        if (!$model) {
            return self::DEFAULT_IMAGE_PATH;
        }

        $resource = $this->getResourceCollection ($model, (int) $request->route()->parameter('id'));

        if (!$resource || !$resource->image || !$this->checkResourceExtsts($resource->image)) {
            return self::DEFAULT_IMAGE_PATH;
        }

        return $resource->image;
    }

    public function checkResourceExtsts($path):bool {
        return $this->file->exists ($path);
    }

    private function getResourceCollection ($model, int $id) {
        return $model->find($id);
    }

    private function getModelByType (string $type) {
        return $this->factory->identifyResource ($type);
    }

    public function retrieveResource (string $path):string {
        return $this->file->get ($path);
    }
    
    public function retrieveContentType (string $path):string {
        return $this->file->mimeType($path);
    }

    public function removeDirectory (string $path) {
        return $this->file->deleteDirectory($path);
    }
}