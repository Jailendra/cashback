<?php

namespace App\Services\Parsers\API\CommissionJunction;

use App\Services\Parsers\API\IProposalDetail;

class ProposalDetail implements IProposalDetail {

    private $proposal;
    private $userId;

    public function __construct (array $proposal) {
        $this->proposal = $proposal;
    }

    public function commission ():?string {
        return is_string ($this->proposal['sale-commission']) ? $this->proposal['sale-commission'] : null;
    }

    public function advertiserId ():int {
        return (int) $this->proposal['advertiser-id'];
    }

    public function advertiserName ():?string {
        return (isset($this->proposal['advertiser-name']) && is_string ($this->proposal['advertiser-name'])) ? $this->proposal['advertiser-name'] : null;
    }

    public function category ():?string {
        return (isset($this->proposal['category']) && is_string ($this->proposal['category'])) ? $this->proposal['category'] : null;
    }

    public function language ():?string {
        return (isset($this->proposal['language']) && is_string ($this->proposal['language'])) ? $this->proposal['language'] : null;
    }

    public function description ():?string {
        return (isset($this->proposal['description']) && is_string ($this->proposal['description'])) ? $this->proposal['description'] : null;
    }

    public function name ():?string {
        return (isset($this->proposal['link-name']) && is_string ($this->proposal['link-name'])) ? $this->proposal['link-name'] : null;
    }

    public function type ():?string {
        return (isset($this->proposal['link-type']) && is_string ($this->proposal['link-type'])) ? $this->proposal['link-type'] : null;
    }

    public function clickUrl ():?string {
        return (isset($this->proposal['clickUrl']) && is_string ($this->proposal['clickUrl'])) ? $this->proposal['clickUrl'].'&sid='.$this->userId : null;
    }

    public function expiryDate ():?string {
        return (isset($this->proposal['promotion-end-date']) && is_string($this->proposal['promotion-end-date'])) ? date ('F, Y d', strtotime ($this->proposal['promotion-end-date'])) : null;
    }

    public function imageUrl ():string {
        $doc = new \DOMDocument();
        @$doc->loadHTML($this->proposal['link-code-html']);
        return $doc->getElementsByTagName('img')->item(0)->getAttribute('src');
    }

    public function setField (string $field, string $value) {
        $this->{$field} = $value;
    }
}