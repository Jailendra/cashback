<?php

namespace App\Services\Parsers\API\TradeTracker;

use App\Services\Parsers\API\IProposalDetail;

class ProposalDetail implements IProposalDetail {

    private $proposal;
    private $commission;
    private $expiryDate;
    private $category;
    private $userId;

    public function __construct (object $proposal) {
        $this->proposal = $proposal;
    }

    public function commission ():?string {
        return $this->commission ?? 0;
    }

    public function advertiserId ():int {
        return (int) $this->proposal->campaign->ID;
    }

    public function advertiserName ():?string {
        return $this->proposal->name;
    }

    public function category ():?string {
        return $this->category ?? null;
    }

    public function language ():?string {
        return null;
    }

    public function description ():?string {
        return $this->proposal->description;
    }

    public function name ():?string {
        return $this->proposal->name;
    }

    public function type ():?string {
        return null;
    }

    public function clickUrl ():?string {
        $doc = new \DOMDocument();
        @$doc->loadHTML($this->proposal->code);
        return $doc->getElementsByTagName('a')->item(0)->getAttribute('href').$this->userId;
    }

    public function expiryDate ():?string {
        return $this->expiryDate ?? $this->proposal->validToDate;
    }

    public function setField (string $field, string $value) {
        $this->{$field} = $value;
    }

    public function imageUrl ():string {
        $doc = new \DOMDocument();
        @$doc->loadHTML($this->proposal->code);
        return $doc->getElementsByTagName('img')->item(0)->getAttribute('src');
    }
}