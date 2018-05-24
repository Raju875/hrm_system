<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Employee Login Form </title>

    <!-- Bootstrap -->
    <link href="{{ asset('asset/user/vendors') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset/user/vendors') }}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('asset/user/vendors') }}/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('asset/user/vendors') }}/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('asset/user/build') }}/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
  <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            @if($message = Session::get('message'))
                <h3 class="text text-danger text-center">{{ $message }}</h3>
            @endif
            <section class="login_content">
                <form action="{{ url('/user/userLoginCheck') }}" method="post">
                    {{ csrf_field() }}
                    <h1>Login Form</h1>
                    <div>
                        <input type="email" class="form-control" name="email" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button  type="submit" class="btn btn-default submit">Log In</button>

                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©{{ date('Y') }} All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

    </div>
</div>
</body>
</html>
