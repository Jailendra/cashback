<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('/a_assets/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/a_assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/a_assets/plugins/iCheck/square/blue.css') }}">
</head>
<body>
<div class="login-box">
  <div class="row">
    <div class="form-group">
      @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
      @endif
      @if (count($errors)) 
        <div class="alert alert-danger">
            @foreach($errors->all() as $error) 
                <p>{{ $error }}  </p>
                @break;
            @endforeach 
        </div>
      @endif 
    </div>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <a class=" col-md-12 text-center clearfix" href="#"><!--<h1>Cashback Website</h1> -->
      <img src="{{asset('/promotional/images/logo.png') }}" width="133px" height="105px">
    </a>
    <div class="clearfix">
    <p class="login-box-msg">Sign in to start your session</p>
</div>
    <form action="{{ url('admin/authenticate') }}" method="post">
    {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name = "username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <button type="submit" name = "submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

  </div>

</div>

</body>
</html>
<style>
body {
    background: url(../promotional/images/bg_image.png) no-repeat center center fixed transparent;
    overflow: hidden;
}

.login-box-body img{
  margin:0 auto;
  text-align:center;
}
.login-box-body{
  border-radius:10px;
  padding: 30px 20px 30px 20px;
}
.login-box{
  width: 410px;
  margin: 0 auto;
  position: absolute;
  left: 50%;
  top: 40%;
  transform: translate(-50%,-50%);
}

</style>