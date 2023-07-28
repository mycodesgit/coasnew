

<?php $__env->startSection('title'); ?>
COAS - V1.0 || Configure Admission
<?php $__env->stopSection(); ?>

@yeild('style')

<?php $__env->startSection('sideheader'); ?>

<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
<ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
  <li>Configure Admission</li>
  <li>Edit <b><?php echo e($time->time); ?></b> Data</li>
</ol>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
  <?php elseif(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div> 
<?php endif; ?>

  <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('timeEdit', $time->id)); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Schedule Time</h4>
       </div>

       <div class="col-md-12" <?php echo e(($errors->has('date')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Date</span></label>
        <select class="form-control" name="date" style="text-transform: uppercase;">
          <option value="<?php echo e($time->date); ?>"><?php echo e($time->date); ?></option>
          <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($date->date); ?>" <?php if(old('date') == "<?php echo e($date->date); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($date->date); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('date')): ?>
        <span class="label label-danger"><?php echo e($errors->first('date')); ?></span>
        <?php endif; ?>
      </div>

      <div class="col-md-12" <?php echo e(($errors->has('time')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Time</span></label>
        <input type="time" name="time" style="text-transform: uppercase;" class="form-control" value="<?php echo e($time->time); ?>">
        <?php if($errors->has('time')): ?>
        <span class="label label-danger"><?php echo e($errors->first('time')); ?></span>
        <?php endif; ?>
      </div>

      <div class="col-md-12" <?php echo e(($errors->has('slots')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Slots</span></label>
        <input type="number" name="slots" style="text-transform: uppercase;" class="form-control" value="<?php echo e($time->slots); ?>">
        <?php if($errors->has('slots')): ?>
        <span class="label label-danger"><?php echo e($errors->first('slots')); ?></span>
        <?php endif; ?>
      </div>

       <div class="col-md-12" style="margin-top: 20px;">
            <div class="text-center">
              <button type="submit" class="btn btn-green-save glyphicon glyphicon-saved"></button>
              <button type="reset" class="btn btn-danger glyphicon glyphicon-repeat"></button>
            </div>
        </div>
      </form>
    </div>

    <div class="col-md-7">
    <table>
       <table class="display nowrap" style="width:100%">
       </table>
       <div style="height:300px; overflow:auto;">
         <table class="display nowrap" style="width:100%">
           <tr>
            <th>Campus</th>
            <th>Date</th>
            <th>Time</th>
            <th>Slots</th>
            <th>Action</th>
            </tr>
          <?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr style="text-transform: uppercase;">
             <td><?php if($time->campus == 'MC'): ?> Main <?php elseif($time->campus == 'SCC'): ?> San Carlos <?php elseif($time->campus == 'VC'): ?> Victorias <?php elseif($time->campus == 'HC'): ?> Hinigaran <?php elseif($time->campus == 'MP'): ?> Moises Padilla <?php elseif($time->campus == 'HinC'): ?> Hinobaan <?php elseif($time->campus == 'SC'): ?> Sipalay <?php elseif($time->campus == 'IC'): ?> Ilog <?php elseif($time->campus == 'CC'): ?> Cauayan <?php endif; ?></td>
             <td><?php echo e($time->date); ?></td>
             <td><?php if($time->time == NULL): ?> <?php else: ?> <?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')); ?><?php endif; ?></td>
             <td><?php echo e($time->slots); ?></td>
             <td style="text-align:center;">
              <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="<?php echo e($time->id); ?>" data-toggle="modal" data-target="#info_app_time" class="btn btn-green glyphicon glyphicon-tasks info_time"></i></a>
            </td>
           </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>  
       </div>
      </table>
    </div>
  </div>

<?php $__env->stopSection(); ?>
 
  <!-- Start time-->
  <div class="modal fade" id="info_app_time" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to remove time data?</h4>
          </div>
          <div class="modal-body">
            <div class="modal-body">
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_time"></a> Edit time</p>
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_time"></a> Remove time</p>
            </div>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End time -->
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admission/configure/editTime.blade.php ENDPATH**/ ?>