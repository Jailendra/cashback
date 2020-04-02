@extends('layouts.app')

@section('content')
<section class="pageBanner"> <img src="images/refer-earn-banner.jpg" class="img-fluid" alt=""> </section>
<!-- End Inner Banner --> 
<!-- Page Content -->
<section class="innerPage">
  <div class="container">
    <div class="inviteFriend">
      <div class="row">
      <div class="col-md-4">
        <div class="inviteFriendContent">
          <div class="box">
            <div class="inviteFriendImage"> <img src="images/group.svg" title="" alt=""> </div>
            <div class="inviteFriendHeading">Invite your Friends</div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="inviteFriendContent">
          <div class="box">
            <div class="inviteFriendImage"> <img src="images/chart-icon.svg" title="" alt=""> </div>
            <div class="inviteFriendHeading">Track your Invitations</div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="inviteFriendContent">
          <div class="box">
            <div class="inviteFriendImage"> <img src="images/fill-1.svg" title="" alt=""> </div>
            <div class="inviteFriendHeading">Earn Referral Rewards</div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="newsletter">
  <div class="content">
  @include('refer.refer')
  </div>
</section>
@endsection