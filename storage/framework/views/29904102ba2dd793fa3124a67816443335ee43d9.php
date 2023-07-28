<?php $__env->startSection('title'); ?>
COAS - V1.0 || Slots
<?php $__env->stopSection(); ?>
<?php
use App\Models\Time;
use App\Models\Applicant;
use App\Models\Venue;
?>
<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li class="active">Availability/Slots</li>
    </ol>
    <div class="container-fluid">
    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>
    
    <div class="page-header" style="margin-top: 0px;">
        <h4>Availability/Slots</h4>
    </div>
    
    <div class="col-md-8">
    <div class="scrollme">
        <?php $__currentLoopData = $date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h4>Admission Date: <?php echo e($date->date); ?></h4>
            <table class="display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Time</th>
                    <th>Availability</th>
                </tr>
                </thead>
                <tbody>
                    <?php if($slots =  Time::where('date', $date->date)->get()): ?>

                    <?php $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$slot->time)->format('h:i A')); ?></td>
                        <td><span class="badge badges"><?php echo e($avail =  Applicant::where('time','=', $slot->time)->where('d_admission','=', $slot->date)->count()); ?></span> / 180</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                </tbody>
            </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<script>
setTimeout(function(){
   window.location.reload();
    }, 90000);
</script>

<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coasnew\resources\views/admission/applicant/slots.blade.php ENDPATH**/ ?>