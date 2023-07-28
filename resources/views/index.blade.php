<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="coas-style.css">
    <link rel="icon" href="dist/img/logo.png" type="image/png">
    <title>CPSU || COAS - Login</title>
  </head>
  <body>
      <div class="container col-lg-offset-2 col-md-offset-3 col-lg-8 col-md-6 login-center bg-inputs">

          <div class="row ads">
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs"> 
              <div class="page-header">
                <h2 style="font-weight: bold;color:#04401f;">CPSU - COAS V1.0</h2>
              </div>

              <h5><b>Update:</b> <i>Posted: +UTC 23:00:23 23:18</i></h5>

               
              <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <p class="lead">Consolidated Online Access System (COAS) is an advanced application system for the University Frontline Services. </p>
                    <p class="lead">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca.</p> 
                  </div>
                  <div class="item">
                    <p class="lead">Consolidated Online Access System (COAS) is an advanced application system for the University Frontline Services. </p>
                    <p class="lead">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca.</p> 
                  </div>
                </div>
              </div>
              <p>Visit <a href="https://cpsu.edu.ph" target="_blank" style="color:#04401f;"><b>Official Website</b></a> for more information.</p>
            </div>

            <div class="col-lg-5 logo">
              <div class="row">
                <a href="{{ URL::route('main') }}"><img src="{{ asset('dist/img/logo.png') }}"></a>
              </div>

              <div class="row">
                <h3 class="login-txt">LOGIN</h3>
                <p class="login-txt-p">Please enter you username and password</p>
              </div>

                <div class="row">
                  <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-lg-8 col-sm-8 col-xs-8">
                    
                    <div class="alert alert-success" id="notifDiv"></div>

                    @if(Session::has('success'))
                          <div class="alert alert-success">{{ Session::get('success')}}</div>
                        @elseif (Session::has('fail'))
                          <div class="alert alert-danger">{{Session::get('fail')}}</div> 
                    @endif

                    <form class="form-horizontal login" method="post" action="{{ URL::route('emp_login') }}">
                    @csrf
                      <div class="form-group">
                          <input type="email" class="form-control input-border" name="email" id="email" placeholder="email ID" value="{{old('email')}}">
                        </div>
                      <div class="form-group">
                          <input type="password" class="form-control input-border" name="password" id="password" placeholder="Password" value="{{old('password')}}">
                          @if ($errors->has('password'))
                          <span style="color:#ffff66;font-size: 10px;">{{ $errors->first('password') }}</span>
                          @endif
                      </div>

                      <div class="form-group checkbox">
                          <label>
                              <input name="remember" id="remember" type="checkbox" value="Remember Me">Remember Me
                          </label>
                                
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                          <button type="submit" class="btn btn-warning">Login</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
  <div class="loader"></div>
</div>
<script src="bootstrap/js/jquery-1.12.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>  

<script>
    window.addEventListener("load", () => {
      const loader = document.querySelector(".loader");
      loader.classList.add("loader--hidden");
      loader.addEventListener("transitioned", () => {
        document.body.removeChild(loader);
      });
    });
</script>

</body>
</html>


      