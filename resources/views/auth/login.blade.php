<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/css/main.css">
    <title>nugree - Admin Login</title>
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/images/favicon-32x32.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
</head>
<body class="loading-page sideBar-active">
<!--<div class="page-loader">
    <div class="page-loader-holder">
        <img src="images/loader.gif" alt="Property42 loading">
    </div>
</div>-->
<div id="wrapper" class="login">
    <header id="header">
        <div class="logo"><a href="#"><img width="477" height="150" alt="Property42" src="{{url('/')}}/web-apps/images/logo.png"></a></div>
    </header>
    <main id="main" role="main">
        <div class="login-page container">
            @if(Session::has('message'))
                <span class="global-error">{{ Session::get('message') }}</span>
            @endif
            <h2>Login</h2>
            {{Form::open(array('url'=>'admin/login','method'=>'POST','class'=>'admin'))}}
            <div class="layout">
                <label for="email">Email</label>
                <div class="input-holder">
                    <input type="email" name="email" id="email" placeholder="Enter you email address">
                </div>
            </div>
            <div class="layout">
                <label for="pass">Password</label>
                <div class="input-holder">
                    <input type="password" name="password" id="pass" placeholder="Enter you password">
                </div>
            </div>
            <div class="layout text-center">
                <button class="btn-default" type="submit">Login<span class="icon-arrow-right"></span></button>
            </div>
            {{Form::close()}}

        </div>
    </main>
</div>

</body>
</html>
