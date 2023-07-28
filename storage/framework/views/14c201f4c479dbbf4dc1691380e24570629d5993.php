<?php $__env->startSection('title'); ?>
COAS - V1.0 || Examinee Result
<?php $__env->stopSection(); ?>


<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>


<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Examinee Result</li>
        <li><?php echo e($assignresult->admission_id); ?></li>
        <li style="text-transform: uppercase;"><?php echo e($assignresult->fname); ?> <?php if($assignresult->mname == null): ?> <?php else: ?> <?php echo e(substr($assignresult->mname,0,1)); ?>.<?php endif; ?> <?php echo e($assignresult->lname); ?>  <?php if($assignresult->ext == 'N/A'): ?> <?php else: ?><?php echo e($assignresult->ext); ?><?php endif; ?></li>
        <li class="active">Assign</li>
    </ol>
    <div class="container-fluid">
    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>

      <div id="updateTestResult" class="tab-pane fade in active">
        <div class="container-fluid">
          <div class="page-header" style="margin-top: 0px;">
            <h4>Update Test Result</h4>
          </div>
        <form method="POST" action="<?php echo e(route('examinee_result_save_nd', $assignresult->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
           <div class="col-md-offset-2 col-md-4">
            <label><span class="label label-default">Raw Score</span></label>
            <input type="text" class="form-control" name="raw_score" value="<?php echo e($assignresult->result->raw_score); ?>">
          </div>
          <div class="col-md-4">
            <label><span class="label label-default">Precentile</span></label>
            <input type="text" class="form-control" name="percentile" value="<?php echo e($assignresult->result->percentile); ?>">
          </div>
          <div class="container-fluid">
          </div>
          <div class="modal-footer text-center" style="border:0px">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-green-save glyphicon glyphicon-saved"></button>
                <button type="reset" class="btn btn-danger glyphicon glyphicon-repeat"></button>
              </div>
          </div>
        </form>
        </div>
      </div>

  </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u841447435/domains/cpsucoas.com/public_html/resources/views/admission/examinee/result.blade.php ENDPATH**/ ?>