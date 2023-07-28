<?php $__env->startSection('title'); ?>
COAS - V1.0 || Print Applicant
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li>Print Reports</li>
        <li class="active">Print Applicant</li>
    </ol>
    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>

    <form method="GET" action="<?php echo e(route('applicant_reports')); ?>">
       <?php echo e(csrf_field()); ?>

        <div class="row"> 
          <div class="col-md-12">
            <div class="container-fluid">
            <div class="searchclub jumbotron">
            <div class="col-md-2">
              <select class="form-control" id="year" name="year">
              </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="campus">
                 <option value="<?php echo e(Auth::user()->campus); ?>"><?php if(Auth::user()->campus == 'MC'): ?> Main <?php elseif(Auth::user()->campus == 'SCC'): ?> San Carlos <?php elseif(Auth::user()->campus == 'VC'): ?> Victorias <?php elseif(Auth::user()->campus == 'HC'): ?> Hinigaran <?php elseif(Auth::user()->campus == 'MP'): ?> Moises Padilla <?php elseif(Auth::user()->campus == 'HinC'): ?> Hinobaan <?php elseif(Auth::user()->campus == 'SC'): ?> Sipalay <?php elseif(Auth::user()->campus == 'IC'): ?> Ilog <?php elseif(Auth::user()->campus == 'CC'): ?> Cauayan <?php endif; ?></option>
                <?php if(Auth::user()->isAdmin == 0): ?>
                <?php else: ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-2">
              <select class="level form-control" name="strand">
                <option value="">Select</option>
                  <?php $__currentLoopData = $strand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($strand->code); ?>" <?php if(old('strand') == "<?php echo e($strand->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($strand->strand); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="col-md-2">
              <input type="date" class="form-control" name="min_date">
              <small class="dateFilter">Start Date</small>
            </div>
            <div class="col-md-2">
              <input type="date" class="form-control" name="max_date">
              <small class="dateFilter">End Date</small>
            </div>
            <div class="col-md-2">
              <button type="submit" class="form-control btn btn-danger">Seach</button>
            </div>
            </div>
          </div>
          </div>
        </div>
    </form>

    <div class="container-fluid"><h4>Filter:  <small><i>Year-, Campus-, ID-,  Strand-, Start Date-, End Date-</i></small></h4>

      <div class="scrollme">
        <table class="table">  
          <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Strand</th>
                    <th>Email</th>
                    <th>Contact #</th>
                </tr>
            </thead>
             <tbody>
                <tr>
                </tr>      
            </tbody>
          </table>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admission/reports/applicant.blade.php ENDPATH**/ ?>