<?php

namespace App\Services\Parsers\API\CommissionJunction;

use App\Services\Parsers\API\IProposal;

class Proposal implements IProposal {

    private $proposal;
    private $logo;

    public function __construct (array $proposal) {
        $this->proposal = $proposal;
    }

    public function advertiserId ():?int {
        return (int) $this->proposal['advertiser-id'];
    }

    public function advertiserName ():?string {
        return $this->proposal['advertiser-name'];
    }

    public function category ():?string {
        return $this->proposal['category'];
    }

    public function description ():?string {
        return $this->proposal['description'];
    }

    public function name ():?string {
        return $this->proposal['link-name'];
    }

    public function total ():?int {
        return $this->proposal['totalCount'];
    }

    public function saleCommission ():?string {
        return (isset($this->proposal['sale-commission']) && is_string($this->proposal['sale-commission'])) ? $this->proposal['sale-commission'] : '0%';
    }

    public function imageUrl ():?string {
        $doc = new \DOMDocument();
        @$doc->loadHTML($this->proposal['link-code-html']);
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