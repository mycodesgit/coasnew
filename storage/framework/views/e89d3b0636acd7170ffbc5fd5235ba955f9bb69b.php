

<?php $__env->startSection('title'); ?>
COAS - V1.0 || Generate Admission Schedules
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
    <li class="active">Generate Admission Schedules</li>
</ol>
<div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
        <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
    <?php endif; ?></p>
    
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <form method="GET" action="<?php echo e(route('schedules_reports')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="jumbotron" style="padding-top:20px;padding-bottom:100px; margin:20px;">
                        <div class="col-md-12">
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
                                <select class="form-control" name="date">
                                    <option value="">Date</option>
                                    <option value="">All</option>
                                    <?php $__currentLoopData = $date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($date->date); ?>" <?php if(old('date') == "<?php echo e($date->date); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($date->date); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="time">
                                    <option value="">Time</option>
                                    <option value="">All</option>
                                    <?php $__currentLoopData = $time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($time->time); ?>" <?php if(old('time') == "<?php echo e($time->time); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="venue">
                                    <option value="">Venue</option>
                                    <option value="">All</option>
                                    <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($venue->venue); ?>" <?php if(old('venue') == "<?php echo e($venue->venue); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($venue->venue); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px;">
                            <div class="col-md-4">
                                <select class="level form-control" name="strand">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $strand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($strand->code); ?>" <?php if(old('strand') == "<?php echo e($strand->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($strand->strand); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="min_date">
                                <small class="dateFilter">Start Date</small>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="max_date">
                                <small class="dateFilter">End Date</small>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="form-control btn btn-danger">Seach</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid"> <h4>Filter: <?php echo e($totalSearchResults); ?> <small><i>Year-<b><?php echo e(request('year')); ?></b>, Campus-<b><?php echo e(request('campus')); ?></b>, Date-<b><?php echo e(request('date')); ?></b>,Time-<b><?php echo e(request('time')); ?></b>,Venue-<b><?php echo e(request('venue')); ?></b>, Strand-<b><?php echo e(request('strand')); ?></b>, Start Date-<b><?php echo e(request('min_date')); ?></b>,  End Date-<b><?php echo e(request('max_date')); ?></b></i></small></h4>
        <div class="">
            <table class="table" id="schedules-reports" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Strand</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($applicant->p_status == 2): ?>
                    <tr>
                        <td style="text-transform: uppercase;"><?php echo e($applicant->fname); ?> <?php if($applicant->mname == null): ?> <?php else: ?> <?php echo e(substr($applicant->mname,0,1)); ?>.<?php endif; ?> <?php echo e($applicant->lname); ?>  <?php if($applicant->ext == 'N/A'): ?> <?php else: ?><?php echo e($applicant->ext); ?><?php endif; ?></td>
                        <td><?php if($applicant->type == 1): ?> New <?php elseif($applicant->type == 2): ?> Returnee <?php elseif($applicant->type == 3): ?> Transferee <?php endif; ?></td>
                        <td><?php echo e($applicant->strand); ?></td>
                        <td><?php echo e($applicant->d_admission); ?></td>
                        <td><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')); ?></td>
                        <td><?php echo e($applicant->venue); ?></td>
                    </tr>
                    <?php else: ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coasnew\resources\views/admission/reports/schedulesgen.blade.php ENDPATH**/ ?>