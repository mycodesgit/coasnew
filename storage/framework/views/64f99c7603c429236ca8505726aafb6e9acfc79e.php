

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
  <li>Edit <b><?php echo e($venue->venue); ?></b> Data</li>
</ol>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
  <?php elseif(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div> 
<?php endif; ?>

  <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('venueEdit', $venue->id)); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Admission Date</h4>
       </div>

      <div class="col-md-12" <?php echo e(($errors->has('venue')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Strand Name</span></label>
        <input type="text" name="venue" style="text-transform: uppercase;" class="form-control" value="<?php echo e($venue->venue); ?>">
        <?php if($errors->has('venue')): ?>
        <span class="label label-danger"><?php echo e($errors->first('venue')); ?></span>
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
            <th>Venue</th>
            <th>Action</th>
            </tr>
          <?php $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr style="text-transform: uppercase;">
             <td><?php if($venue->campus == 'MC'): ?> Main <?php elseif($venue->campus == 'SCC'): ?> San Carlos <?php elseif($venue->campus == 'VC'): ?> Victorias <?php elseif($venue->campus == 'HC'): ?> Hinigaran <?php elseif($venue->campus == 'MP'): ?> Moises Padilla <?php elseif($venue->campus == 'HinC'): ?> Hinobaan <?php elseif($venue->campus == 'SC'): ?> Sipalay <?php elseif($venue->campus == 'IC'): ?> Ilog <?php elseif($venue->campus == 'CC'): ?> Cauayan <?php endif; ?></td>
             <td><?php echo e($venue->venue); ?></td>
             <td style="text-align:center;">
              <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="<?php echo e($venue->id); ?>" data-toggle="modal" data-target="#info_app_venue" class="btn btn-green glyphicon glyphicon-tasks info_venue"></i></a>
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
  <div class="modal fade" id="info_app_venue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to remove venue data?</h4>
          </div>
          <div class="modal-body">
            <div class="modal-body">
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_venue"></a> Edit venue</p>
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_venue"></a> Remove venue</p>
            </div>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End time -->
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admission/configure/editVenue.blade.php ENDPATH**/ ?>