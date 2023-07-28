

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
</ol>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
  <?php elseif(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div> 
<?php endif; ?>

  <div class="tab-content">
  <div id="appPrograms" class="tab-pane fade in active">
    <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('add_Program')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Programs</h4>
       </div>

        <div class="col-md-12" <?php echo e(($errors->has('code')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Program Code</span></label>
        <input type="text" name="code" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('code')); ?>" placeholder="Program Code">
        <?php if($errors->has('code')): ?>
        <span class="label label-danger"><?php echo e($errors->first('code')); ?></span>
        <?php endif; ?>
      </div>


      <div class="col-md-12" <?php echo e(($errors->has('program')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Program Name</span></label>
        <input type="text" name="program" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('program')); ?>" placeholder="Program Name">
        <?php if($errors->has('program')): ?>
        <span class="label label-danger"><?php echo e($errors->first('program')); ?></span>
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
       <div style="height:500px; overflow:auto;">
         <table class="display nowrap" style="width:100%">
           <tr>
              <th>Code</th>
              <th>Program</th>
              <th class="text-center">Action</th>
          </tr>
          <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr style="text-transform: uppercase;">
              <td><?php echo e($programs->code); ?></td>
              <td><?php echo e($programs->program); ?></td>
              <td style="text-align:center;">
              <a data-toggle="tooltip" data-placement="bottom" title="Program"><i id="<?php echo e($programs->id); ?>" data-toggle="modal" data-target="#info_app_program" class="btn btn-green glyphicon glyphicon-tasks info_program"></i></a>
            </td>
          </tr>  
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
         </table>  
       </div>
      </table>
    </div>
  </div>

  <div id="appStrand" class="tab-pane fade">
    <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('add_Strand')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Strands</h4>
       </div>

        <div class="col-md-12" <?php echo e(($errors->has('code')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Strand Code</span></label>
        <input type="text" name="code" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('code')); ?>" placeholder="Strand Code">
        <?php if($errors->has('code')): ?>
        <span class="label label-danger"><?php echo e($errors->first('code')); ?></span>
        <?php endif; ?>
      </div>


      <div class="col-md-12" <?php echo e(($errors->has('strand')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Strand Name</span></label>
        <input type="text" name="strand" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('strand')); ?>" placeholder="Strand Name">
        <?php if($errors->has('strand')): ?>
        <span class="label label-danger"><?php echo e($errors->first('strand')); ?></span>
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
       <div style="height:500px; overflow:auto;">
         <table class="display nowrap" style="width:100%">
           <tr>
            <th>Code</th>
            <th>Strand</th>
            <th>Action</th>
            </tr>
          <?php $__currentLoopData = $strand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr style="text-transform: uppercase;">
             <td><?php echo e($strand->code); ?></td>
             <td><?php echo e($strand->strand); ?></td>
             <td style="text-align:center;">
              <a data-toggle="tooltip" data-placement="bottom" title="Strand"><i id="<?php echo e($strand->id); ?>" data-toggle="modal" data-target="#info_app_strand" class="btn btn-green glyphicon glyphicon-tasks info_strand"></i></a>
            </td>
           </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </table>  
       </div>
      </table>
    </div>
  </div>

  <div id="appAdDate" class="tab-pane fade">
    <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('add_admission_date')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Admission Date</h4>
       </div>

        <div class="col-md-12" <?php echo e(($errors->has('date')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Admission Date</span></label>
        <input type="date" name="date" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('date')); ?>">
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
          <?php $__currentLoopData = $date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

  <div id="appTime" class="tab-pane fade">
    <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('add_admission_time')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Schedule Time</h4>
       </div>

      <div class="col-md-12" <?php echo e(($errors->has('date')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Date</span></label>
        <select class="form-control" name="date" style="text-transform: uppercase;">
          <option value="">Select Date</option>
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
        <input type="time" name="time" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('time')); ?>">
        <?php if($errors->has('time')): ?>
        <span class="label label-danger"><?php echo e($errors->first('time')); ?></span>
        <?php endif; ?>
      </div>

      <div class="col-md-12" <?php echo e(($errors->has('slots')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Slots</span></label>
        <input type="number" name="slots" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('slots')); ?>" placeholder="Slots">
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
          <?php $__currentLoopData = $time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

    <div id="appVenue" class="tab-pane fade">
    <div class="col-md-3 jumbotron">
    <form method="post" action="<?php echo e(URL::route('add_admission_venue')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="page-header" style="margin-top: 0px;">
          <h4>Venue</h4>
       </div>

      <div class="col-md-12" <?php echo e(($errors->has('venue')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Venue</span></label>
        <input type="text" name="venue" style="text-transform: uppercase;" class="form-control" value="<?php echo e(old('venue')); ?>">
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
          <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
</div>

<div class="col-md-2">
    <div class="page-header" style="margin-top: 0px;">
      <h4>Manage Menu</h4>
    </div>
    <ul class="nav nav-pills nav-stacked">
    <li class="list-group-item active"><a data-toggle="tab" href="#appPrograms">Programs</a></li>
    <li class="list-group-item"><a data-toggle="tab" href="#appStrand">Strand</a></li>
    <li class="list-group-item"><a data-toggle="tab" href="#appAdDate">Admission Date</a></li>
    <li class="list-group-item"><a data-toggle="tab" href="#appTime">Schedule Time</a></li>
    <li class="list-group-item"><a data-toggle="tab" href="#appVenue">Venue</a></li>
  </ul>
</div>
<?php $__env->stopSection(); ?>

  <!-- StartProgram -->
  <div class="modal fade" id="info_app_program" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to remove program data?</h4>
          </div>
          <div class="modal-body">
            <div class="modal-body">
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_program"></a> Edit program data</p>
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_program"></a> Remove program</p>
            </div>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End Program -->

    <!-- StartStrand -->
  <div class="modal fade" id="info_app_strand" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to remove strand data?</h4>
          </div>
          <div class="modal-body">
            <div class="modal-body">
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_strand"></a> Edit strand data</p>
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_strand"></a> Remove strand</p>
            </div>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End Strand -->

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
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u841447435/domains/cpsucoas.com/public_html/resources/views/admission/configure/index.blade.php ENDPATH**/ ?>