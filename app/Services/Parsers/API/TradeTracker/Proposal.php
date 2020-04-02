<?php

namespace App\Services\Parsers\API\TradeTracker;

use App\Services\Parsers\API\IProposal;

class Proposal implements IProposal {

    private $proposal;
    private $logo;
    private $commission;

    public function __construct (object $proposal) {
        $this->proposal = $proposal;
    }

    public function advertiserId ():?int {
        return $this->proposal->campaign->ID;
    }

    public function advertiserName ():?string {
        return $this->proposal->name;
    }

    public function category ():?string {
        return null;
    }

    public function description ():?string {
        return $this->proposal->description;
    }

    public function name ():?string {
        return $this->proposal->name;
    }

    public function total ():?int {
        return $this->proposal->total;
    }

    public function saleCommission ():?string {
        return ($this->commission ?? 0) . '%';
    }

    public function imageUrl ():?string {
        $doc = new \DOMDocument();
        @$doc->loadHTML($this->proposal->code);
        return $doc->getElementsByTagName('img')->item(0)->getAttribute('src');
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