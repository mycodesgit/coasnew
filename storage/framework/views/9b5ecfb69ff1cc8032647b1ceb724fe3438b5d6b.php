

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
  <li>Edit <b><?php echo e($date->date); ?></b> Data</li>
</ol>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
  <?php elseif(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div> 
<?php endif; ?>

  <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('dateEdit', $date->id)); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Admission Date</h4>
       </div>

      <div class="col-md-12" <?php echo e(($errors->has('date')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Strand Name</span></label>
        <input type="date" name="date" style="text-transform: uppercase;" class="form-control" value="<?php echo e($date->date); ?>">
        <?php if($errors->has('date')): ?>
        <span class="label label-danger"><?php echo e($errors->first('date')); ?></span>
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
            <th>Action</th>
            </tr>
          <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr style="text-transform: uppercase;">
             <td><?php if($date->campus == 'MC'): ?> Main <?php elseif($date->campus == 'SCC'): ?> San Carlos <?php elseif($date->campus == 'VC'): ?> Victorias <?php elseif($date->campus == 'HC'): ?> Hinigaran <?php elseif($date->campus == 'MP'): ?> Moises Padilla <?php elseif($date->campus == 'HinC'): ?> Hinobaan <?php elseif($date->campus == 'SC'): ?> Sipalay <?php elseif($date->campus == 'IC'): ?> Ilog <?php elseif($date->campus == 'CC'): ?> Cauayan <?php endif; ?></td>
             <td><?php echo e($date->date); ?></td>
             <td style="text-align:center;">
              <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="<?php echo e($date->id); ?>" data-toggle="modal" data-target="#info_app_date" class="btn btn-green glyphicon glyphicon-tasks info_date"></i></a>
            </td>
           </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>  
       </div>
      </table>
    </div>
  </div>

<?php $__env->stopSection(); ?>
 
  <!-- Start Date-->
  <div class="modal fade" id="info_app_date" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to remove date data?</h4>
          </div>
          <div class="modal-body">
            <div class="modal-body">
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_date"></a> Edit date</p>
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_date"></a> Remove date</p>
            </div>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End Date -->
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admission/configure/editDate.blade.php ENDPATH**/ ?>