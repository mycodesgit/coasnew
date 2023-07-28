<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo e(asset('coas-style.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('dist/img/logo.png')); ?>">
    <title>COAS - V1.0 || Apply Admission</title>
  </head>

  <?php $__env->startSection('style'); ?>
    <style type="text/css">
    .tableFixHead {overflow-y: auto;height: 700px;}
    .tableFixHead thead th {position: relative;top: 0px;}
    th,td {padding: 8px 16px;border: 1px solid #ccc;}
    th {background: #eee;}
    .dataTables_filter {float: center !important;margin-top: -50px;}
    .dateFilter{position:absolute;font-size: 10px;color:#d9534f;}
    </style>
  <?php echo $__env->yieldSection(); ?>

  <body>
 
    <nav class="navbar-default navbar-fixed-top">
      <a class="navbar-brand" href="#">COAS V.1.0</a>
      <div class="navbar-header navbar-fixed-top text-center">
          <img src="<?php echo e(asset('dist/img/logo.png')); ?>" style="width:100px;">
      </div>
    </nav>

  <div class="container-fluid" style="margin-top: 65px;">
    <div class="col-md-offset-1 col-md-9 jumbotron" style="background-color: #fff;">
      <ol class="breadcrumb">
          <li><a href="<?php echo e(route('admission-portal')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
          <li class="active">Track Admission</li>
      </ol>

      <p><?php if(Session::has('success')): ?>
          <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
        <?php elseif(Session::has('fail')): ?>
          <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
      <?php endif; ?></p>

    <div class="row">

      <form method="GET" action="<?php echo e(route('admission-track-status')); ?>">
       <?php echo e(csrf_field()); ?>

        <div class="row"> 
          <div class="col-md-12">
            <div class="container-fluid">
            <div class="searchclub jumbotron">
            
            <div class="col-md-4">
              <input type="text" class="form-control" name="admission_id" placeholder="Applicant ID">
            </div>
            <div class="col-md-2">
              <button type="submit" class="form-control btn btn-green hidden-sm hidden-xs">Seach</button>
              <button type="submit" class="form-control btn btn-green hidden-lg hidden-md" style="margin-top: 10px;">Seach</button>
            </div>

            </div>

          </div>
          </div>
        </div>
      </form>

        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm" style="border:2px solid #04401f;">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo e(asset('dist/img/logo.png')); ?>" style="margin:auto;padding: 30px 0;" alt="" class="img-rounded img-responsive"/>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <button class="btn btn-default pull-right" onclick="copyToClipboard('#p1')">Copy ID</button>
                        <h4>Admission ID: <span id="p1"><?php echo e(old('admissionid')); ?></span></h4>
                        <h5>Name: <?php echo e(old('firstname')); ?> <?php echo e(old('mname')); ?> <?php echo e(old('lastname')); ?></h5>
                        <h5>Preferred Campus: <?php if(old('campus') == 'MC'): ?> Main <?php elseif(old('campus') == 'SCC'): ?> San Carlos <?php elseif(old('campus') == 'VC'): ?> Victorias <?php elseif(old('campus') == 'HC'): ?> Hinigaran <?php elseif(old('campus') == 'MP'): ?> Moises Padilla <?php elseif(old('campus') == 'HinC'): ?> Hinobaan <?php elseif(old('campus') == 'SC'): ?> Sipalay <?php elseif(old('campus') == 'IC'): ?> Ilog <?php elseif(old('campus') == 'CC'): ?> Cauayan <?php endif; ?></h5>
                        <h5>Date of Birth: <?php echo e(old('bday')); ?></h5>
                        <h5>Email Address: <?php echo e(old('email')); ?></h5>
                        <h5>Contact: <?php echo e(old('contact')); ?></h5>
                        <h5>Present Address:<?php echo e(old('address')); ?></h5>
                    </div>
                </div>
            </div>
          </div>

        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="well well-sm" style="border:2px solid #04401f;">
              <ul class="timeline">
              <li>
                <div class="timeline-badge success">
                  <span class="glyphicon glyphicon-check"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;"><?php echo e(date('M d, Y')); ?></h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Application</p>
                       <h5>Submitted/Recorded Applicant Information</h5>
                       <h6>Status: Applied for Admission</h6>
                       <h6><i>Date: <?php echo e(date('m-d-Y')); ?></i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
              </li>
              <li>
                <div class="timeline-badge warning">
                  <span class="glyphicon glyphicon-hourglass"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;">Waiting</h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Examination Schedule</p>
                       <h5>Exam Schedule set! <b>Date</b>: , <b>Time</b>: , <b>Venue</b>: </h5>
                       <h6><i>Status: Waiting</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
              </li>

              <li>
                <div class="timeline-badge warning">
                  <span class="glyphicon glyphicon-hourglass"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;">Waiting</h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Examination Results</p>
                       <h5>Results is out! Your <b>score</b>: , <b>Percentile</b>: </h5>
                       <h6><i>Status: Waiting</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
              </li>

              <li>
                <div class="timeline-badge warning">
                  <span class="glyphicon glyphicon-hourglass"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;">Waiting</h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Confirmation</p>
                       <h5>Waiting for confirmation on Pre-enrolment!</h5>
                       <h6><i>Status: Waiting</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
              </li>

              <li>
                <div class="timeline-badge warning">
                  <span class="glyphicon glyphicon-hourglass"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;">Waiting</h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Acceptance</p>
                       <h5>Accepted for the program: <b></b></h5>
                       <h6><i>Status: Waiting</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
              </li>

            </ul>
          </div>
        </div>
    </div>
  </div>
  </div>

    <footer class="footer">
      <div class="container">
           <p class="text-muted">CPSU - COAS V.1.0 is built through O-S Technology, a Shukerz-Based product. Copyright © 2023 CPSU, All Rights Reserved.</p>
      </div>
    </footer>

    <script src="<?php echo e(asset('bootstrap/js/jquery-1.12.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app.js')); ?>"></script>
  </body>
</html>

<script type="text/javascript">
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><?php /**PATH C:\xampp\htdocs\resources\views/portal/admission_current.blade.php ENDPATH**/ ?>