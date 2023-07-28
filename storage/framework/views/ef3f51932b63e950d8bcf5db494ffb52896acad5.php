

<?php $__env->startSection('title'); ?>
COAS - V1.0 || Examinee Result
<?php $__env->stopSection(); ?>

<style type="text/css">
body
{
  font:14px Arial, sans-serif;
}
.container
{
  display: block;
    margin:5%;
}

.image-header
{
  display: block;
  margin:auto;
    margin-left: auto;
    margin-right: auto;
    width:60%;
}
.image-header img
{
    width:60px;
}
.image-header .sch-txt
{
  position: absolute;
  font:bold 14px Arial, sans-serif;
  margin-top: 5px;
  margin-left: 0px;
}
.image-header .address-txt
{
  position: absolute;
  margin-top: 20px;
  margin-left: 30px;
}
.picture-header
{
  width: 130px;
  height: 120px;
  border: 1px solid #000;
  padding: 1px;
  margin: 1px;
  position: absolute;
  margin-top: -60px;
  margin-left: 510px;
}
.slip-txt
{
  margin-top: -10px;
  margin-left: 250px;
  font-weight: bold;
}
.status
{
  display: inline-block;
  font-weight: bold;
  margin-left: 160px;
  word-spacing: 10px;
  margin-top: 20px;
}
.name .checkbox
{
  margin:auto;
  margin:10px;
  display: inline;
}
input.checkbox 
{
   transform: scale(1.1);
     margin: 10px;
     display: inline;
}
.name
{
  width: 100%;
  padding-bottom:10px;
  margin-top: 20px;
  font-size: 12px;
}
.name-p
{
   display: inline-block;
   padding-right: 10px;
}
.name-sex
{
   display: inline-block;
   width:8%;
}
.name-p-c
{
  border-bottom: 1px solid #000;
  display: inline-block;
  text-transform: uppercase;
  width: 56%;
}
.name-p-sex
{
  border-bottom: 1px solid #000;
  display: inline-block;
  text-transform: uppercase;
}
.name-p-s
{
   display: inline-block;
   padding-right: 10px;
   margin-left: 20px;
   font-style: italic;
}
.name-p-s-left
{
   margin-left: 50px;
}
.name-p-address
{
  border-bottom: 1px solid #000;
  display: inline-block;
  width:70%;
}
.name-p-signatories
{
  border-bottom: 1px solid #000;
  display: inline-block;
  text-transform: uppercase;
}
</style>

<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>


<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Examinee Result</li>
        <li><?php echo e($assignresult->admission_id); ?></li>
        <li><?php echo e(ucwords(strtolower($assignresult->fname))); ?> <?php echo e(ucwords($assignresult->mname[0])); ?>. <?php echo e(ucwords(strtolower($assignresult->lname))); ?></li>
        <li class="active">Assign</li>
    </ol>
    <div class="container-fluid">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#updateTestResult" style="color:#008000;">Update Test Result</a></li>
        <li><a data-toggle="tab" href="#genPreEnrolment" style="color:#008000;">Generate Pre-enrolment</a></li>
        <li><a data-toggle="tab" href="#appImage" style="color:#008000;">Capture Image</a></li>
        <li><a data-toggle="tab" href="#conPreEnrolent" style="color:#008000;">Confirm Pre-enrolment</a></li>
      </ul>

    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>

    <div class="tab-content">
      <div id="updateTestResult" class="tab-pane fade in active">
        <form method="POST" action="<?php echo e(route('examinee_result_save_nd', $assignresult->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
          
          <div class="container-fluid">
          </div>

          <div class="page-header" style="margin-top: 0px;">
            <h4>Assign Result</h4>
          </div>
           <div class="col-md-offset-2 col-md-4">
            <label><span class="label label-default">Raw Score</span></label>
            <input type="text" class="form-control" name="raw_score" value="<?php $__currentLoopData = $assign; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($assign->raw_score); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
          </div>
          <div class="col-md-4">
            <label><span class="label label-default">Precentile</span></label>
            <input type="text" class="form-control" name="percentile" value="<?php $__currentLoopData = $per; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($per->percentile); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
          </div>
          <div class="container-fluid">
          </div>
          <div class="modal-footer text-center" style="border:0px">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-warning">Save</button>
              </div>
          </div>
        </form>
      </div>

    <div id="genPreEnrolment" class="tab-pane fade">
        <iframe src="<?php echo e(route('genPreEnrolment', $assignresult->id)); ?>" width="100%" height="800"></iframe>
    </div>

    <div id="appImage" class="tab-pane fade">
      <div class="container-fluid">
          <div class="row">
          <p><?php if(Session::has('success')): ?>
              <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
            <?php elseif(Session::has('fail')): ?>
              <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
          <?php endif; ?></p>

          <form method="POST" action="<?php echo e(route('applicant_save_image', $assignresult->id)); ?>">
          <?php echo csrf_field(); ?>
          <div class="row col-md-6">
            <label>Camera</label>
            <div id="coas_camera" class="coas_camera"></div>
            <input type=button class="capture_snapshot btn btn-warning" value="Capture Snapshot" onClick="capture_snapshot()">
              <input type="hidden" name="image" class="image-tag">
        </div>
        
        <div class="row col-md-6">
          <label>Result</label>
          <div id="results" class="coas_camera_result"></div>
          <?php echo e(csrf_field()); ?>

              <button class="capture_snapshot btn btn-warning">Submit</button>
        </div>
        </form>
      </div>
    </div>
    </div>

    <div id="conPreEnrolent" class="tab-pane fade">
      <div class="container-fluid">
        <div class="row">
          <div class="container-fluid">
            <p><a href="<?php echo e(route('confirmPreEnrolment', $assignresult->id)); ?>" type="button" class="btn btn-default glyphicon glyphicon-check"></a> Confirm Pre-Enrolment</p> 
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('bootstrap/js/webcam.min.js')); ?>"></script>   
<script language="JavaScript">
     Webcam.set({
         width: 320,
         height: 240,
         image_format: 'jpeg',
         jpeg_quality: 90
     });
    Webcam.attach('#coas_camera');

    function capture_snapshot() {
       Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        });
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Devs\coas\resources\views/admission/examinee/result.blade.php ENDPATH**/ ?>