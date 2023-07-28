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
      <a class="navbar-brand" href="#">CPSU - COAS V.1.0</a>
      <div class="navbar-header navbar-fixed-top text-center">
          <img src="<?php echo e(asset('dist/img/logo.png')); ?>" style="width:100px;">
      </div>
    </nav>

  <div class="container-fluid" style="margin-top: 65px;">
    <div class="col-md-offset-1 col-md-9 jumbotron" style="background-color: #fff;">
      <ol class="breadcrumb">
          <li><a href="<?php echo e(route('admission-portal')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
          <li>Admission</li>
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
            <div class="col-md-2">
              <input type="text" class="form-control" name="admission_id" placeholder="Applicant ID" >
            </div>
            <div class="col-md-2">
              <button type="submit" class="form-control btn btn-danger">Seach</button>
            </div>
            </div>
          </div>
          </div>
        </div>
      </form>

        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm" style="border:2px solid #efff04;">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo e(asset('dist/img/logo.png')); ?>" style="margin:auto;padding: 30px 0;" alt="" class="img-rounded img-responsive"/>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h4>Admission ID: <?php echo e($applicant->admission_id); ?><span id="p1"></span></h4>
                        <h5>Name: <?php echo e($applicant->fname); ?> <?php echo e(substr($applicant->mname,0,1)); ?>. <?php echo e($applicant->lname); ?></h5>
                        <h5>Preferred Campus: <?php if($applicant->campus == 'MC'): ?> Main <?php elseif($applicant->campus == 'SCC'): ?> San Carlos <?php elseif($applicant->campus == 'VC'): ?> Victorias <?php elseif($applicant->campus == 'HC'): ?> Hinigaran <?php elseif($applicant->campus == 'MP'): ?> Moises Padilla <?php elseif($applicant->campus == 'HinC'): ?> Hinobaan <?php elseif($applicant->campus == 'SC'): ?> Sipalay <?php elseif($applicant->campus == 'IC'): ?> Ilog <?php elseif($applicant->campus == 'CC'): ?> Cauayan <?php endif; ?></h5>
                        <h5>Date of Birth: <?php echo e($applicant->bday); ?></h5>
                        <h5>Email Address: <?php echo e($applicant->email); ?></h5>
                        <h5>Contact: <?php echo e($applicant->contact); ?></h5>
                        <h5>Present Address:<?php echo e($applicant->address); ?></h5>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                  <h5 style="font-size: 10px;"><?php echo e($applicant->created_at->format('M d, Y')); ?></h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Application</p>
                       <h5>Submitted/Recorded Applicant Information</h5>
                       <h6 class="text-success">Status: Applied for Admission</h6>
                       <h6><i>Date: <?php echo e($applicant->created_at->format('m-d-Y h:i A')); ?></i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
              </li>
              <li>
                <?php if($applicant->p_status == 2 || $applicant->p_status == 3 || $applicant->p_status == 4 || $applicant->p_status == 5): ?>
                <div class="timeline-badge success">
                  <span class="glyphicon glyphicon-check"></span>
                </div>
 
                <div class="timeline-date">
                  <h5 style="font-size: 10px;"><?php echo e($applicant->result->created_at->format('M d, Y')); ?></h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Examination Schedule</p>
                       <h5>Exam Schedule set! <b>Date</b>: <?php echo e($applicant->d_admission); ?>, <b>Time</b>: <?php echo e(Carbon\Carbon::parse($applicant->time)->format('h:i A')); ?>, <b>Venue</b>: <?php echo e($applicant->venue); ?></h5>
                       <?php if($applicant->p_status == 2 || $applicant->p_status == 3 || $applicant->p_status == 4 || $applicant->p_status == 5): ?>
                       <h6><i>Status: Scheduled</i></h6>
                       <?php else: ?>
                       <h6><i>Status: Waiting</i></h6>
                       <?php endif; ?>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
                <?php else: ?>
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
                <?php endif; ?>
              </li>

              <li>
                <?php if($applicant->p_status == 3 || $applicant->p_status == 4 || $applicant->p_status == 5): ?>
                <div class="timeline-badge success">
                  <span class="glyphicon glyphicon-check"></span>
                </div>   
                <div class="timeline-date">
                  <h5 style="font-size: 10px;"><?php echo e($applicant->result->created_at->format('M d, Y')); ?></h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Examination Results</p>
                       <h5>Results is out! Your <b>score</b>: <?php echo e($applicant->result->raw_score); ?>, <b>Percentile</b>: <?php echo e($applicant->result->percentile); ?></h5>
                       <h6><i>Status: <?php echo e($applicant->result->created_at->format('m-d-Y h:i A')); ?></i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
                <?php else: ?>
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
                <?php endif; ?>
              </li>

              <li>
               <?php if($applicant->p_status == 4 || $applicant->p_status == 5): ?>
                <div class="timeline-badge success">
                  <span class="glyphicon glyphicon-check"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;"><?php echo e($applicant->updated_at->format('M d, Y')); ?></h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Confirmation</p>
                       <h5>Confirmed pre-enrolment!</h5>
                       <h6><i>Status: Confirmed</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
                <?php else: ?>
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
                <?php endif; ?>
              </li>

              <li>
                <?php if($applicant->p_status == 5): ?>
                <div class="timeline-badge success">
                  <span class="glyphicon glyphicon-check"></span>
                </div>
                <div class="timeline-date">
                  <h5 style="font-size: 10px;"><?php echo e($applicant->interview->created_at->format('M d, Y')); ?></h5>
                </div>
                 <div class="timeline-panel">
                   <div class="timeline-heading">
                     <div class="timeline-title">
                       <p>Acceptance</p>
                       <h5>Accepted for the program <b><?php echo e($applicant->interview->course); ?></b></h5>
                       <h6><i>Status: Accepted</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
                <?php else: ?>
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
                       <h5>Accepted for the program <b></b></h5>
                       <h6><i>Status: Waiting</i></h6>
                     </div>
                   </div>
                   <div class="timeline-body">
                     <div class="row">
                     </div>
                   </div>
                </div>
                <?php endif; ?>
              </li>

            </ul>
          </div>
        </div>
    </div>
  </div>
  </div>

    <footer class="footer">
      <div class="container">
           <p class="text-muted">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca Copyright © 2023 CPSU, All Rights Reserved.</p>
      </div>
    </footer>

    <script src="<?php echo e(asset('bootstrap/js/jquery-1.12.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app.js')); ?>"></script>
  </body>
</html><?php /**PATH C:\coas\resources\views/portal/track.blade.php ENDPATH**/ ?>