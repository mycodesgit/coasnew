<?php $__env->startSection('title'); ?>
COAS - V1.0 || Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sideheader'); ?>
<h4>Settings</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('style'); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
<ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
  <li>Settings</li>
</ol>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
  <?php elseif(Session::has('fail')): ?>
    <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div> 
<?php endif; ?>

<div class="container-fluid">
  <div class="col-md-5 jumbotron">
    <form method="POST" action="<?php echo e(route('account_update', $user->id)); ?>">
        <?php echo e(csrf_field()); ?>

        <?php echo method_field('PUT'); ?>
        <div class="page-header" style="margin-top: 0px;">
          <h4>Administer User Data</h4>
       </div>

       <div class="col-md-6" <?php echo e(($errors->has('type')) ? 'has-error' : ''); ?>>
          <label><span class="label label-default">User Level</span></label>
          <select class="form-control" name="type" required="" style="text-transform: uppercase;">
            <option value="<?php echo e($user->isAdmin); ?>"><?php if($user->isAdmin == 1): ?> Guidance Officer <?php elseif($user->isAdmin == 2): ?> Guidance Staff <?php elseif($user->isAdmin == 3): ?> Registrar <?php elseif($user->isAdmin == 4): ?> Registrar Staff <?php elseif($user->isAdmin == 5): ?> College Dean <?php elseif($user->isAdmin == 6): ?> Program Head <?php elseif($user->isAdmin == 7): ?> College Staff <?php endif; ?></option>
            <option value="1" <?php if(old('type') == 1): ?> <?php echo e('selected'); ?> <?php endif; ?>>Guidance Officer</option>
            <option value="2" <?php if(old('type') == 2): ?> <?php echo e('selected'); ?> <?php endif; ?>>Guidance Staff</option>
            <option value="3" <?php if(old('type') == 3): ?> <?php echo e('selected'); ?> <?php endif; ?>>Registrar</option>
            <option value="4" <?php if(old('type') == 4): ?> <?php echo e('selected'); ?> <?php endif; ?>>Registrar Staff</option>
            <option value="5" <?php if(old('type') == 5): ?> <?php echo e('selected'); ?> <?php endif; ?>>College Dean</option>
            <option value="6" <?php if(old('type') == 6): ?> <?php echo e('selected'); ?> <?php endif; ?>>Program Head</option>
            <option value="7" <?php if(old('type') == 7): ?> <?php echo e('selected'); ?> <?php endif; ?>>College Staff</option>
          </select>
          <?php if($errors->has('type')): ?>
          <span class="label label-danger"><?php echo e($errors->first('type')); ?></span>
          <?php endif; ?>
        </div>

       <div class="col-md-6" <?php echo e(($errors->has('campus')) ? 'has-error' : ''); ?>>
          <label><span class="label label-default">Campus</span></label>
            <select class="form-control" name="campus" required="" style="text-transform: uppercase;">
            <option value="<?php echo e($user->campus); ?>"><?php if($user->campus == 'MC'): ?> Main <?php elseif($user->campus == 'SCC'): ?> San Carlos <?php elseif($user->campus == 'VC'): ?> Victorias <?php elseif($user->campus == 'HC'): ?> Hinigaran <?php elseif($user->campus == 'MP'): ?> Moises Padilla <?php elseif($user->campus == 'HinC'): ?> Hinobaan <?php elseif($user->campus == 'SC'): ?> Sipalay <?php elseif($user->campus == 'IC'): ?> Ilog <?php elseif($user->campus == 'CC'): ?> Cauayan <?php endif; ?></option>
            <?php if($user->campus == 'MC'): ?> <?php else: ?> <option value="MC">Main</option><?php endif; ?>
            <?php if($user->campus == 'SCC'): ?> <?php else: ?> <option value="SCC">San Carlos</option><?php endif; ?>
            <?php if($user->campus == 'VC'): ?> <?php else: ?> <option value="VC">Victorias</option><?php endif; ?>
            <?php if($user->campus == 'HC'): ?> <?php else: ?> <option value="HC">Hinigaran</option><?php endif; ?>
            <?php if($user->campus == 'MP'): ?> <?php else: ?> <option value="MP">Moises Padilla</option><?php endif; ?>
            <?php if($user->campus == 'HinC'): ?> <?php else: ?> <option value="HinC">Hinobaan</option><?php endif; ?>
            <?php if($user->campus == 'SC'): ?> <?php else: ?> <option value="SC">Sipalay</option><?php endif; ?>
            <?php if($user->campus == 'IC'): ?> <?php else: ?> <option value="IC">Ilog</option><?php endif; ?>
            <?php if($user->campus == 'CC'): ?> <?php else: ?> <option value="CC">Cauayan</option><?php endif; ?>
          </select>
        </div>

        <div class="col-md-12" <?php echo e(($errors->has('department')) ? 'has-error' : ''); ?>>
          <label><span class="label label-default">Department</span></label>
            <select class="form-control" name="department" required="" style="text-transform: uppercase;">
            <option value="<?php echo e($user->dept); ?>"><?php if($user->dept == 'CCS'): ?> College of Computer Studies <?php elseif($user->dept == 'COTED'): ?> College of Teacher Education <?php elseif($user->dept == 'CCJE'): ?> College of Criminal Justice Education <?php elseif($user->dept == 'COE'): ?> College of Engineering <?php elseif($user->dept == 'CAF'): ?> College of Agriculture and Forestry <?php elseif($user->dept == 'CBM'): ?> College of Business Management <?php elseif($user->dept == 'Guidance Office'): ?> Guidance Office
            <?php elseif($user->dept == 'Registrar Office'): ?> Registrar Office
            <?php elseif($user->dept == 'Assessment Office'): ?> Assessment Office
            <?php elseif($user->dept == 'Cashier Office'): ?> Cashier Office
            <?php elseif($user->dept == 'Scholarship Office'): ?> Scholarship Office
            <?php elseif($user->dept == 'Graduate School Registrar'): ?> Graduate School Registrar
            <?php endif; ?></option>
            <option value="CCS" <?php if(old('department') == 'CCS'): ?> <?php echo e('selected'); ?> <?php endif; ?>>College of Computer Studies</option>
            <option value="COTED" <?php if(old('department') == 'COTED'): ?> <?php echo e('selected'); ?> <?php endif; ?>>College of Teacher Education</option>
            <option value="CCJE" <?php if(old('department') == 'CCJE'): ?> <?php echo e('selected'); ?> <?php endif; ?>>College of Criminal Justice Education</option>
            <option value="COE" <?php if(old('department') == 'COE'): ?> <?php echo e('selected'); ?> <?php endif; ?>>College of Engineering</option>
            <option value="CAF" <?php if(old('department') == 'CAF'): ?> <?php echo e('selected'); ?> <?php endif; ?>>College of Agriculture and Forestry</option>
            <option value="CBM" <?php if(old('department') == 'CBM'): ?> <?php echo e('selected'); ?> <?php endif; ?>>College of Business Management</option>
            <option value="Guidance Office" <?php if(old('department') == 'Guidance Office'): ?> <?php echo e('selected'); ?> <?php endif; ?>>Guidance Office</option>
            <option value="Registrar Office" <?php if(old('department') == 'Registrar Office'): ?> <?php echo e('selected'); ?> <?php endif; ?>>Registrar Office</option>
            <option value="Assessment Office" <?php if(old('department') == 'Assessment Office'): ?> <?php echo e('selected'); ?> <?php endif; ?>>Assessment Office</option>
            <option value="Scholarship Office" <?php if(old('department') == 'Scholarship Office'): ?> <?php echo e('selected'); ?> <?php endif; ?>>Scholarship Office</option>
            <option value="Cashier Office" <?php if(old('department') == 'Cashier Office'): ?> <?php echo e('selected'); ?> <?php endif; ?>>Cashier Office</option>
            <option value="Graduate School Registar" <?php if(old('department') == 'Graduate School Registar'): ?> <?php echo e('selected'); ?> <?php endif; ?>>Graduate School Registar</option>
          </select>
        </div>

        <div class="col-md-6" <?php echo e(($errors->has('lastname')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Lastname</span></label>
        <input type="text" name="lastname" class="form-control" value="<?php echo e($user->lname); ?>" style="text-transform: uppercase;">
        <?php if($errors->has('lastname')): ?>
        <span class="label label-danger"><?php echo e($errors->first('lastname')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-6" <?php echo e(($errors->has('firstname')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Firstname</span></label>
        <input type="text" name="firstname" class="form-control" value="<?php echo e($user->fname); ?>" style="text-transform: uppercase;">
        <?php if($errors->has('firstname')): ?>
        <span class="label label-danger"><?php echo e($errors->first('firstname')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-6">
        <label><span class="label label-default">Middlename</span></label>
        <input type="text" name="middlename" class="form-control" value="<?php echo e($user->mname); ?>" style="text-transform: uppercase;">
      </div>

      <div class="col-md-6">
      <label><span class="label label-default">Ext.</span></label>
      <select class="form-control" name="ext">
          <option value="<?php echo e($user->ext); ?>"><?php if($user->ext == ''): ?> N/A <?php elseif($user->ext == 'Jr.'): ?> Jr. <?php elseif($user->ext == 'Sr.'): ?> Sr. <?php elseif($user->ext == 'III'): ?> III <?php elseif($user->ext == 'IV'): ?> IV <?php endif; ?></option>
          <?php if($user->ext == ''): ?> <?php else: ?> <option value="">N/A</option><?php endif; ?>
          <?php if($user->ext == 'Jr.'): ?> <?php else: ?> <option value="Jr.">Jr.</option><?php endif; ?>
          <?php if($user->ext == 'Sr.'): ?> <?php else: ?> <option value="Sr.">Sr.</option><?php endif; ?>
          <?php if($user->ext == 'III'): ?> <?php else: ?> <option value="III">III</option><?php endif; ?>
          <?php if($user->ext == 'IV'): ?> <?php else: ?> <option value="IV">IV</option><?php endif; ?>
        </select>
      </div>

        <div class="col-md-6">
          <div class="form-group" <?php echo e(($errors->has('email')) ? 'has-error' : ''); ?>>
           <label><span class="label label-default">Email Address</span></label>
           <input class="form-control" type="email" name="email" id="email" value="<?php echo e($user->email); ?>">
              <?php if($errors->has('email')): ?>
            <?php echo e($errors->first('email')); ?>

              <?php endif; ?>
          </div>
      </div>

      <div class="col-md-6">
         <div class="form-group" <?php echo e(($errors->has('password')) ? 'has-error' : ''); ?>>
         <label><span class="label label-default">Password</span></label>
         <input class="form-control" type="password" placeholder="************" disabled="">
         <?php if($errors->has('password')): ?>
          <?php echo e($errors->first('password')); ?>

            <?php endif; ?>
         </div>
         </div>

         <div class="col-md-12">
            <div class="text-center">
              <button type="submit" class="col-md-12 btn btn-warning">Update Account</button>
            </div>
        </div>

    </form>
  </div>

<?php if(Auth::user()->id == 8): ?>

<div class="col-md-5">
    <div class="scrollme">
        <table id="userSettings" class="display nowrap" style="width:100%">
          <thead>
                <tr>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Campus</th>
                    <th>Office</th>
                    <th>Action</th>
                </tr>
            </thead>
             <tbody>
              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(Auth::user()->isAdmin == $user->isAdmin): ?>
                <?php else: ?>
                <tr style="text-transform: uppercase;">
                  <td><?php echo e($user->lname); ?> <?php echo e($user->fname); ?> <?php if($user->mname == null): ?> <?php else: ?><?php echo e($user->mname); ?><?php endif; ?> <?php if($user->ext == 'N/A'): ?> <?php else: ?><?php echo e($user->ext); ?><?php endif; ?></td>
                  <td><?php if($user->isAdmin == 1): ?> Guidance Officer <?php elseif($user->isAdmin == 2): ?> Guidance Staff <?php elseif($user->isAdmin == 3): ?> Registrar <?php elseif($user->isAdmin == 4): ?> Registrar Staff <?php elseif($user->isAdmin == 5): ?> College Dean <?php elseif($user->isAdmin == 6): ?> Program Head <?php elseif($user->isAdmin == 7): ?> College Staff <?php endif; ?></td>
                  <td><?php if($user->campus == 'MC'): ?> Main <?php elseif($user->campus == 'SCC'): ?> San Carlos <?php elseif($user->campus == 'VC'): ?> Victorias <?php elseif($user->campus == 'HC'): ?> Hinigaran <?php elseif($user->campus == 'MP'): ?> Moises Padilla <?php elseif($user->campus == 'HinC'): ?> Hinobaan <?php elseif($user->campus == 'SC'): ?> Sipalay <?php elseif($user->campus == 'IC'): ?> Ilog <?php elseif($user->campus == 'CC'): ?> Cauayan <?php endif; ?></td>
                  <td><?php echo e($user->dept); ?></td>
                  <td style="text-align:center;">
                      <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="<?php echo e($user->id); ?>" data-toggle="modal" data-target="#user_settings" class="bbtn btn-green glyphicon glyphicon-tasks settings"></i></a>
                      </td>
                  </tr>   
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
  </div>
<?php else: ?>
<div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-md-5 jumbotron">
    <form method="POST" action="<?php echo e(route('changepassUpdate', Auth::user()->id)); ?>">
        <?php echo e(csrf_field()); ?>

        <?php echo method_field('PUT'); ?>
        <div class="page-header" style="margin-top: 0px;">
          <h4>Change Password: <span style="text-transform: uppercase;"><?php echo e($user->lname); ?> <?php echo e($user->fname); ?> <?php if($user->mname == null): ?> <?php else: ?> <?php echo e(substr($user->mname,0,1)); ?>.<?php endif; ?> <?php if($user->ext == 'N/A'): ?> <?php else: ?><?php echo e($user->ext); ?><?php endif; ?></span></h4>
       </div>

         <div class="col-md-12">
         <div class="form-group" <?php echo e(($errors->has('password')) ? 'has-error' : ''); ?>>
         <label><span class="label label-default">New Password</span></label>
         <input class="form-control" type="password" name="password" id="password" placeholder="Enter New Password">
            <?php if($errors->has('password')): ?>
          <?php echo e($errors->first('password')); ?>

            <?php endif; ?>
         </div>
        </div>

         <div class="col-md-12">
         <div class="form-group" <?php echo e(($errors->has('confirmation')) ? 'has-error' : ''); ?>>
         <label><span class="label label-default">Confirm Password</span></label>
         <input class="form-control" type="password" name="confirmation" id="confirmation" placeholder="Confirm New Password">
         <?php if($errors->has('confirmation')): ?>
          <?php echo e($errors->first('confirmation')); ?>

            <?php endif; ?>
         </div>
        </div>

        <div class="col-md-12">
            <div class="text-center">
              <button type="submit" class="col-md-12 btn btn-warning">Update Password</button>
            </div>
        </div>

    </form>
  </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#userSettings').DataTable( {
        "ordering": false,
        scrollY: '420px', scrollCollapse: true, paging: false,
      });
  });
  </script>
<?php $__env->stopSection(); ?>


<!-- Start Configure Users -->
<div class="modal fade bs-example-modal-sm" id="user_settings" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Select Transaction</h4>
          </div>
          <div class="modal-body">
            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_user"></a> Edit User Data</p>
            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-lock" id="btn_changepass_user"></a> Change Password</p>
            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_user"></a> Remove User</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
</div> 
<!-- End Configure Users -->

<?php echo $__env->make('layouts.master_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/control/settings/edit.blade.php ENDPATH**/ ?>