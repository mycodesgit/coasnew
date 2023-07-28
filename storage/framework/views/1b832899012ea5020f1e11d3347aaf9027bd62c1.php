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
      <div class="container col-lg-offset-2 col-md-offset-4 col-sm-offset-3 col-xs-offset-3 col-lg-8 col-md-6 col-sm-6 col-xs-6 login-center bg-inputs">

          <div class="row ads">
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs"> 
              <div class="page-header">
                <h2 style="font-weight: bold;color:#04401f;">CPSU - COAS V1.0</h2>
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

            <div class="col-lg-5 col-sm-6 logo">
              <div class="row">
                <img src="dist/img/logo.png">
              </div>

              <div class="row">
                <p class="login-txt-p">Select Transaction</p>
              </div>

                <div class="row">
                  <div class="col-lg-offset-2 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-lg-8 col-sm-10 col-xs-10">
                    <div class="alert alert-success" id="notifDiv"></div>
                      <a href="<?php echo e(route('admission-apply')); ?>" type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">Apply Admission</h5></a>
                      <a href="<?php echo e(route('admission-track')); ?>" type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">Track Admission</h5></a>
                      <button type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">Student Portal</h5></button>
                      <button type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">CPSU e-LMS</h5></button>
                      <button type="button" class="btn btn-warning btn-block" style="border-radius: 0"> <h5 class="mb-1">Student Manual</h5></button>

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
<?php /**PATH C:\coas\resources\views/portal/index.blade.php ENDPATH**/ ?>