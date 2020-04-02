<?php

namespace App\Traits;

trait Proposal {

    function groupAdvertiserByAggregator ($advertisers):array {
        return [current ($advertisers->items())->aggregator()->first()->name => array_map (function ($advertiser) {
            return [
                    'advertiser_id' => $advertiser->advertiser_id,
                    'advertiser_name' => $advertiser->advertiser_name,
                    'logo' => $advertiser->image ? $advertiser->logo : null, 
                    'commission' => $advertiser->commission
            ];
        }, $advertisers->items())];
    }

    function setAdvertiserData (array $advertisors, array $proposals, string $aggregatorName) {
        switch (strtoupper ($aggregatorName)) {
            case 'COMMISSION JUNCTION':
                array_walk ($proposals, function ($proposal) use ($advertisors) {
                    // find logo of the advertiser
                    $logo = $advertisors[array_search ($proposal->advertiserId(), array_column($advertisors, 'advertiser_id'))]['logo'];
        
                    // inject advertiser custom logo into proposal
                    $logo ? $proposal->setField('logo', $logo) : null;
                });
                break;
            case 'TRADETRACKER':
                array_walk ($proposals, function ($proposal) use ($advertisors) {
                    // find logo of the advertiser
                    $advertisor = $advertisors[array_search ($proposal->advertiserId(), array_column($advertisors, 'advertiser_id'))];;
        
                    // inject advertiser custom logo into proposal
                    $proposal->setField('commission', $advertisor['commission']);
                    $proposal->setField('logo', $advertisor['logo']);
                });
                break;
        }
    }

    public function updateDetail ($aggregatorName, $detail, $advertiser, $user) {
        switch (strtoupper ($aggregatorName)) {
            case 'COMMISSION JUNCTION':
                array_walk ($detail, function ($offer) use ($advertiser, $user) {
                    // check if user is login
                    if ($user && $user->id) {
                        // add user detail into click-url
                        $offer->setField ('userId', $user->id);
                    }
                });
                break;
            case 'TRADETRACKER':
                array_walk ($detail, function ($offer) use ($advertiser, $user) {
                    $offer->setField ('commission', $advertiser->commission. '%');
                    $offer->setField ('category', current ($advertiser->categories));
                    ($advertiser->end_at && !$offer->expiryDate()) ? $offer->setField ('expiryDate', $advertiser->end_at) : null;

                    // check if user is login
                    if ($user && $user->id) {
                        // add user detail into click-url
                        $offer->setField ('userId', $user->id);
                    }
                });
        }

        return $detail;
    }
}