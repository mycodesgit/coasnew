<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="coas-style.css">
    <link rel="icon" href="dist/img/logo.png" type="image/png">
    <title>CPSU || COAS - Login</title>
  </head>
  <body>
      <div class="container col-lg-offset-2 col-md-offset-3 col-lg-8 col-md-6 login-center bg-inputs">
          <div class="row ads">
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs"> 
              <div class="page-header">
                <h2 style="font-weight: bold;color:#04401f;">COAS V1.0</h2>
              </div>
              <h5><b>Update:</b> <i>Posted: +UTC 23:00:23 23:18</i></h5>               
              <div id="carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <p class="lead">Consolidated Online Access System (COAS) is an advanced application system for the Univeristy Frontline Services. </p>
                    <p class="lead">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca.</p> 
                  </div>
                  <div class="item">
                    <p class="lead">Consolidated Online Access System (COAS) is an advanced application system for the Univeristy Frontline Services. </p>
                    <p class="lead">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca.</p> 
                  </div>
                </div>
              </div>
              <p>Visit <a href="https://cpsu.edu.ph" target="_blank" style="color:#04401f;"><b>Official Website</b></a> for more information.</p>
            </div>

            <div class="col-lg-5 col-md-12 col-sm-12 logo">
              <div class="row">
                <a href="<?php echo e(URL::route('main')); ?>"><img src="<?php echo e(asset('dist/img/logo.png')); ?>"></a>
              </div>

              <div class="row">
                <p class="login-txt-p">Select Transaction</p>
              </div>

                <div class="row">
                  <div class="col-lg-offset-2 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-8 col-sm-10 col-xs-10">
                    <div class="alert alert-success" id="notifDiv"></div>
                      <a href="<?php echo e(route('admission-portal')); ?>" type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">Student</h5></a>
                      <a href="<?php echo e(route('home')); ?>" type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">Employee</h5></a>
                      <a href="https://cpsu.edu.ph" type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">CPSU Website</h5></a> 
                      <br /><br/>
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
<?php /**PATH C:\xampp\htdocs\resources\views/main.blade.php ENDPATH**/ ?>