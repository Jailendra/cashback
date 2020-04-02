<?php

namespace App\Factories;

use App\Models\Coupon;
use App\Models\AdvertisorCustom;

class ResourceFactory {

    public function identifyResource (string $type) {
        switch (strtoupper ($type)) {
          case 'TRADEMARK':
            return new Coupon ();
          case 'ADVERTISER':
            return new AdvertisorCustom ();
        }
      }
}