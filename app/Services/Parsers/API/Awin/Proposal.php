<?php

namespace App\Services\Parsers\API\Awin;

use App\Services\Parsers\API\IProposal;

class Proposal implements IProposal {

    private $proposal;
    private $logo;

    public function __construct (object $proposal) {
        $this->proposal = $proposal;
    }

    public function advertiserId ():?int {
        return $this->proposal->programmeInfo->id;
    }

    public function advertiserName ():?string {
        return $this->proposal->programmeInfo->name;
    }

    public function category ():?string {
        return null;
    }

    public function description ():?string {
        return null;
    }

    public function name ():?string {
        return $this->proposal->programmeInfo->name;
    }

    public function total ():?int {
        return 1;
    }

    public function saleCommission ():?string {
        $range = $this->proposal->commissionRange;
        $currency = $this->proposal->programmeInfo->currencyCode;
        $commission = null;
        array_walk ($range, function ($slice) use ($commission, $currency) {
            $commission .= $slice->max . (($slice->type === 'percentage') ? '%' : $currency);
        });
        return $commission;
    }

    public function imageUrl ():?string {
        return $this->proposal->programmeInfo->logoUrl;
    }

    public function toArray():array {
        return [
            'advertiserId' => $this->advertiserId(),
            'advertiserName' => $this->advertiserName (),
            'category' => $this->category (),
            'description' => $this->description(),
            'name' => $this->name(),
            'total' => $this->total(),
            'imageUrl' => $this->imageUrl(),
            'logo' => $this->logo(),
            'saleCommission' => $this->saleCommission()
        ];
    }

    public function setField (string $name, string $value) {
        $this->{$name} = $value;
    }

    public function logo():?string {
        return $this->logo;
    }
}