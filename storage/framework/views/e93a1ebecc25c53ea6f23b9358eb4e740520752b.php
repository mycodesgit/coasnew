<?php $__env->startSection('title'); ?>
COAS - V1.0 || Schedule Examination
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Schedule Examination</li>
        <li><?php echo e($applicant->admission_id); ?></li>
        <li style="text-transform: uppercase;"><?php echo e($applicant->fname); ?> <?php if($applicant->mname == null): ?> <?php else: ?> <?php echo e(substr($applicant->mname,0,1)); ?>.<?php endif; ?> <?php echo e($applicant->lname); ?>  <?php if($applicant->ext == 'N/A'): ?> <?php else: ?><?php echo e($applicant->ext); ?><?php endif; ?></li>
        <li class="active">Schedule</li>
    </ol>
    <div class="container-fluid">
    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>

    <form method="POST" action="<?php echo e(route('applicant_schedule_save', $applicant->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
      
      <div class="container-fluid">
      </div>

      <div class="page-header" style="margin-top: 0px;">
        <h4>Schedule Examination</h4>
      </div>
       <div class="col-md-4">
        <label><span class="label label-default">Date of Admission Test</span></label>
        <select class="form-control" name="d_admission" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->d_admission); ?>"><?php echo e($applicant->d_admission); ?></option>
          <?php $__currentLoopData = $date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($date->date); ?>" <?php if(old('d_admission') == "<?php echo e($date->date); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($date->date); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-md-4">
        <label><span class="label label-default">Time</span></label>
        <select class="form-control" name="time" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->time); ?>"><?php if($applicant->time == NULL): ?> <?php else: ?> <?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')); ?><?php endif; ?></option>
          <?php $__currentLoopData = $time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($time->time); ?>" <?php if(old('time') == "<?php echo e($time->time); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-md-4">
        <label><span class="label label-default">Venue</span></label>
        <select class="form-control" name="venue" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->venue); ?>"><?php echo e($applicant->venue); ?></option>
          <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($venue->venue); ?>" <?php if(old('venue') == "<?php echo e($venue->venue); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($venue->venue); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="container-fluid">
      </div>
       <div class="modal-footer text-center">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-green-save glyphicon glyphicon-saved"></button>
            <button type="reset" class="btn btn-danger glyphicon glyphicon-repeat"></button>
          </div>
      </div>
    </form>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u841447435/domains/cpsucoas.com/public_html/resources/views/admission/applicant/schedule.blade.php ENDPATH**/ ?>