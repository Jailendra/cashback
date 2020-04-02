<?php

namespace App\Services\Parsers\API\CommissionJunction;

use App\Services\Parsers\API\IProposalDetail;

class DetailParser {

    public function parse (object $advertiserProposal):array {
        return array_map (function ($proposal) {
            return $this->proposal ($proposal);
        }, end ($advertiserProposal->{key($advertiserProposal)}));
    }

    private function proposal (object $proposal):IProposalDetail {
        return new ProposalDetail ((array) $proposal);
    }
}