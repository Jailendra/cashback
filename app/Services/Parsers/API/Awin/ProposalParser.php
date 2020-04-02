<?php

namespace App\Services\Parsers\API\Awin;
use App\Services\Parsers\API\IProposal;

class ProposalParser {
    public function parse (object $proposals):array {
        return array_map (function ($proposal) {
            return $this->proposal ($proposal);
        }, end ($proposals->{key($proposals)}));
    }

    private function proposal (object $proposal):IProposal {
        return new Proposal ($proposal);
    }
}