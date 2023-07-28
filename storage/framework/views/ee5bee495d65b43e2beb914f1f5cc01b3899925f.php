<?php $__env->startSection('title'); ?>
COAS - V1.0 || Print Applicant
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('style'); ?>

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
    <div class="container-fluid"><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
        <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
    <?php endif; ?></div>
    <form method="GET" action="<?php echo e(route('applicant_reports')); ?>">
        <?php echo e(csrf_field()); ?>

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
                    <button type="submit" class="form-control btn btn-danger">Search</button>
                </div>
            </div>&nbsp;
            <h4>Filter: <?php echo e($totalSearchResults); ?> 
                <small>
                    <i>
                        Year-<b><?php echo e(request('year')); ?></b>, 
                        Campus-<b><?php echo e(request('campus')); ?></b>,
                        Strand-<b><?php echo e(request('strand')); ?></b>,
                        Start Date-<b><?php echo e(request('min_date')); ?></b>, 
                        End Date-<b><?php echo e(request('max_date')); ?></b>
                    </i>
                </small>
            </h4>
        </div>
    </form>
    <div class="container-fluid">
        <table id="applicant-reports" class="table table-hover" style="width:100%">
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
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($applicant->p_status != 6): ?>
                    <tr>
                        <td style="text-transform: uppercase;"><?php echo e($applicant->fname); ?> 
                            <?php if($applicant->mname == null): ?> 
                                <?php else: ?> <?php echo e(substr($applicant->mname,0,1)); ?>.
                            <?php endif; ?> <?php echo e($applicant->lname); ?>  

                            <?php if($applicant->ext == 'N/A'): ?> 
                                <?php else: ?><?php echo e($applicant->ext); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($applicant->type == 1): ?> New 
                                <?php elseif($applicant->type == 2): ?> Returnee 
                                <?php elseif($applicant->type == 3): ?> Transferee 
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($applicant->strand); ?></td>
                        <td><?php echo e($applicant->email); ?></td>
                        <td><?php echo e($applicant->contact); ?></td>
                    </tr>
                    <?php else: ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coasnew\resources\views/admission/reports/applicantgen.blade.php ENDPATH**/ ?>