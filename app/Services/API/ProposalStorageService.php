<?php

namespace App\Services\API;

use App\Services\StorageService;

class ProposalStorageService {

    private $directory;

    public function __construct (StorageService $storageService) {
        $this->storageService = $storageService;
    }

    public function setDirectory (string $path) {
        $this->directory = $path;
    }

    public function checkAdvertiserResourceExtsts (int $advertiserId):bool {
        return $this->storageService->checkResourceExtsts ($this->getAdvertiserResourceName ($advertiserId));
    }

    private function getAdvertiserResourceName (int $advertiserId):string {
        return $this->directory.'/'.$advertiserId.'.txt';
    }

    public function retrieveAdvertiserResource (int $advertiserId):string {
        return $this->storageService->retrieveResource ($this->getAdvertiserResourceName ($advertiserId));
    }

    /**
     * Method to save Advertiser offers response into file cache
     */
    public function saveAdvertiserResponse (int $advertiserId, object $proposals) {
        if ($this->checkAdvertiserResourceExtsts($advertiserId)) {
            $resource = json_decode ($this->retrieveAdvertiserResource ($advertiserId));
            $proposals->links->link = array_merge ($resource->links->link, $proposals->links->link);
        }
        // save into file cache
        return $this->storageService->store ($this->getAdvertiserResourceName ($advertiserId), json_encode ($proposals, JSON_PRETTY_PRINT));
    }

    public function retrieveResource (string $path) {
        return $this->storageService->retrieveResource ($path);
    }
}