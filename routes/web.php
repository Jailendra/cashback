<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/	

Auth::routes();

Route::group([], function ($route) {
    $route->get('/', 'HomeController@index')->name('home');
    $route->get('/proposals/{advertiserId}', 'ProposalController@proposalDetail')->name('proposalDetail');
    $route->get('/refer', 'ReferController@index')->name('refer');
    $route->get('/coupons', 'CouponController@index')->name('coupons');
    $route->get('/special-coupons', 'CouponController@getSpecialCoupons');

    $route->get('/resources/{id}/{type}', 'ResourceController@getResource')->name('resources');
    $route->get('/VIP', 'Auth\VipController@index')->name('vip');
    $route->post('/save-vip', 'Auth\VipController@register')->name('store.vip');

    $route->group(['middleware' => 'auth'], function () use ($route) {
        
        // routes accessed by user only
        $route->group(['middleware' => 'role:user'], function () use ($route) {
            $route->group(['prefix' => 'subscriptions'], function () use ($route) {

                $route->get('/', 'PayPlanController@all')->name('subscriptions');

                $route->get('/active', 'SubscriptionController@userSubscription')->name('user-subscriptions')->middleware('checkSubscription');
                $route->post('purchase', 'SubscriptionController@purchase')->name('subscriptions-purchase');
            });
        });

        $route->group(['middleware' => 'role:user,admin'], function () use ($route) {
            $route->post('/refer', 'ReferController@sendReferRequest')->name('refer');
            $route->get('/profile-settings', 'UserController@index')->name('user.profile');
            $route->put('/profile-update', 'UserController@update')->name('user.profile.update');
            $route->get('/cashback', 'CommissionController@getUserCashback')->name('sum-cashback');
            $route->put('/cashback', 'CommissionController@requestCashback')->name('request-cashback');
            $route->get('/bank-details', 'UserController@createBankDetails')->name('bank.details');
            $route->put('/bank-update', 'UserController@updateBankDetails')->name('bank.update');
            $route->get('/change-password', 'UserController@showChangePassword')->name('change.password');
            $route->post('/update-password', 'UserController@updateChangePassword')->name('update.password');
        });

        $route->group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () use ($route) {
            $route->get('user/{userId}', 'UserController@getUser')->name('admin.user.view');

            $route->group(['namespace' => 'admin'], function () use ($route) {
                $route->get('/home', 'CouponController@home')->name('admin.home');
                $route->group(['prefix' => 'coupons'], function () use ($route) {
                    $route->get('/', 'CouponController@index')->name('admin.coupon');
                    $route->get('create', 'CouponController@create')->name('coupon.add');
                    $route->post('/', 'CouponController@store')->name('coupon.add');
                    $route->delete('{id}', 'CouponController@delete')->name('coupon.delete');
                    $route->put('{id}', 'CouponController@update')->name('coupon.update');
                    $route->get('{id}', 'CouponController@view');
                });
                $route->group(['prefix' => 'affiliate'], function () use ($route) {
                    $route->get('/', 'CommissionDistributionController@index')->name('affiliate');
                });
            });

            // subscription routes
            $route->group(['prefix' => 'subscriptions'], function () use ($route) {
                $route->get('/', 'SubscriptionController@index')->name('subscription-list');
                $route->get('create', 'SubscriptionController@create')->name('subscription-create');
                $route->post('/', 'SubscriptionController@store')->name('subscription-store');
                $route->get('{subscriptionId}', 'SubscriptionController@edit')->name('subscription-update');
                $route->put('{subscriptionId}', 'SubscriptionController@update')->name('subscription.update');
            });

            /**
             * Admin-advertisers Route
             */
            $route->group(['prefix' => 'advertisers'], function () use ($route) {
                $route->get('/', 'AdvertiserController@index')->name('admin.advertiser');
                $route->put('{id}', 'AdvertiserController@update')->name('advertiser.update');
                $route->get('{id}', 'AdvertiserController@view')->name('advertiser.view');
            });

            // Commission report
            $route->group(['prefix' => 'commissions'], function () use ($route) {
                $route->get('/', 'CommissionController@index')->name('commission.report');
                $route->get('/request-cashback', 'CommissionController@pendingCashbackList')->name('request-cashback-list');
                $route->get('/request-cashback/{userId}/detail', 'CommissionController@pendingUserCashbackDetail')->name('request-cashback-detail');
                $route->post('/request-cashback/process', 'CommissionController@processCashback')->name('cashback-process');
                $route->get('/request-cashback/processed', 'CommissionController@processedCashback')->name('processed-cashback');
            });

            // aggregators route for admin
            $route->group(['prefix' => 'aggregator'], function () use ($route) {
                $route->get('/', 'AggregatorController@index')->name('admin.aggregator');
                $route->patch('{id}', 'AggregatorController@update')->name('aggregator.update');
            });

            // payplan route for admin
            $route->group(['prefix' => 'plan'], function () use ($route) {
                
                $route->get('/', 'PayPlanController@index')->name('admin.payplans');
                $route->get('/create', 'PayPlanController@create')->name('payplan.create');
                $route->post('/', 'PayPlanController@store')->name('payplan.store');
            });

            // users route for admin
            $route->group(['prefix' => 'users'], function () use ($route) {
                $route->get('/', 'UserController@getUsers')->name('admin.users');
            });

        });
    });
});