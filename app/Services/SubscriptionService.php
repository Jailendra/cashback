<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Apis\Stripe\Stripe;

class SubscriptionService {

    public function __construct (Stripe $stripe) {
        $this->stripe = $stripe;
    }

    public function getPlanById (string $stripe_id):object {
        return $this->stripe->getPlanById($stripe_id);
    }

    public function purchase (Request $request) {

        $user = $request->user();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if(empty($user->stripe_id)){
            $user->createAsStripeCustomer();
        }
        return $user->newSubscription('main', $request->plan)->create($request->paymentMethod, [
            'email' => $user->email,
        ]);
    }

    public function userActiveSubscription (Request $request) {
        $subscription = $request->user()->subscription()->latest()->first();
        return $this->getUserSubscription($subscription->stripe_id);
    }

    protected function getUserSubscription($stripe_id){
        $e = null;
        try{
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $subscription = \Stripe\Subscription::retrieve($stripe_id);
        }catch(\Stripe\Error\Card $e) {

            // Since it's a decline, \Stripe\Error\Card will be caught

        } catch (\Stripe\Error\RateLimit $e) {

            // Too many requests made to the API too quickly

        } catch (\Stripe\Error\InvalidRequest $e) {

            // Invalid parameters were supplied to Stripe's API

        } catch (\Stripe\Error\Authentication $e) {

            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)

        } catch (\Stripe\Error\ApiConnection $e) {

            // Network communication with Stripe failed

        } catch (\Stripe\Error\Base $e) {

            // Display a very generic error to the user, and maybe send
            // yourself an email

        } catch (Exception $e) {

            // Something else happened, completely unrelated to Stripe

        }
        if($e){
            $body = $e->getJsonBody();
            $err  = $body['error'];
            print('Status is:' . $e->getHttpStatus() . "\n");
            print('Type is:' . $err['type'] . "\n");
            print('Code is:' . $err['code'] . "\n");
            print('Param is:' . $err['param'] . "\n");
            print('Message is:' . $err['message'] . "\n"); die;
        }else{
            return $subscription;
        }
    }
}