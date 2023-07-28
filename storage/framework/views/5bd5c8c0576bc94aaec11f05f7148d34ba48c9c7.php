<?php $__env->startSection('title'); ?>
COAS - V1.0 || Examinee List
<?php $__env->stopSection(); ?>

@yeild('style')

<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li class="active">Examinee List</li>
    </ol>
    <div class="row">
    <div class="container-fluid"><p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p></div>
    <form method="GET" action="<?php echo e(route('srchexamineeList')); ?>">
       <?php echo e(csrf_field()); ?>

            <div class="container-fluid">
            <div class="searchclub jumbotron">
            <div class="col-md-2">
              <select class="form-control" id="year" name="year">
              </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="campus">
                 <option value="<?php echo e(Auth::user()->campus); ?>"><?php if(Auth::user()->campus == 'MC'): ?> Main <?php elseif(Auth::user()->campus == 'SCC'): ?> San Carlos <?php elseif(Auth::user()->campus == 'VC'): ?> Victorias <?php elseif(Auth::user()->campus == 'HC'): ?> Hinigaran <?php elseif(Auth::user()->campus == 'MP'): ?> Moises Padilla <?php elseif(Auth::user()->campus == 'HinC'): ?> Hinobaan <?php elseif(Auth::user()->campus == 'SC'): ?> Sipalay <?php elseif(Auth::user()->campus == 'IC'): ?> Ilog <?php elseif(Auth::user()->campus == 'CC'): ?> Cauayan <?php endif; ?></option>
                <?php if(Auth::user()->isAdmin == 0): ?>
                <option value="MC">Main</option>
                <option value="SCC">San Carlos</option>
                <option value="VC">Victorias</option>
                <option value="HC">Hinigaran</option>
                <option value="MP">Moises Padilla</option>
                <option value="HinC">Hinobaan</option>
                <option value="SC">Sipalay</option>
                <option value="IC">Ilog</option>
                <option value="CC">Cauayan</option>
                <?php else: ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control" name="admission_id" placeholder="Applicant ID">
            </div>
            <div class="col-md-3">
              <select class="form-control" name="strand">
                <option value="">Strand</option>
                <option value="BAM">Accountancy, Business, & Management (ABM)</option>
                <option value="GAS">General Academic Strand (GAS)</option>
                <option value="HUMSS">Humanities, Education, Social Sciences (HUMSS)</option>
                <option value="STEM">Science, Technology, Engineering, & Mathematics (STEM)</option>
                <option value="TVL-CHF">TVL - Cookery, Home Economics, & FBS (TVL-CHF)</option>
                <option value="TVL-CIV">TVL - CSS, ICT, & VGD (TVL-CIV)</option>
                <option value="TVL-AFA">TVL - Agricultural & Fisheries Arts (TVL-AFA)</option>
                <option value="TVL-EIM">TVL - Electrical Installation & Maintenance (TVL-EIM)</option>
                <option value="TVL-SMAW">TVL - Shielded Metal Arc Welding (TVL-SMAW)</option>
                <option value="OLD">Old Curriculum</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="form-control btn btn-danger">Seach</button>
            </div>
            </div>
            <h4>Search Results: <?php echo e($totalSearchResults); ?> <small><i>Year-<b><?php echo e(request('year')); ?></b>, Campus-<b><?php echo e(request('campus')); ?></b>, ID-<b><?php echo e(request('admission_id')); ?></b>,  Strand-<b><?php echo e(request('strand')); ?></b></i></small></h4>
          </div>
    </form>

    <div class="container-fluid">
    <table id="applicant-list" class="display nowrap" style="width:100%">
       <thead>
                <tr>
                    <th>Examinee ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Contact #</th>
                    <th>Exam Schedule</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($applicant->p_status == 2): ?> 
                <tr>
                  <td><?php echo e($applicant->admission_id); ?></td>
                  <td style="text-transform: uppercase;"><b><?php echo e($applicant->fname); ?> <?php if($applicant->mname == null): ?> <?php else: ?> <?php echo e(substr($applicant->mname,0,1)); ?>.<?php endif; ?> <?php echo e($applicant->lname); ?>  <?php if($applicant->ext == 'N/A'): ?> <?php else: ?><?php echo e($applicant->ext); ?><?php endif; ?></b></td>
                  <td><?php if($applicant->type == 1): ?> New <?php else: ?> Transferee <?php endif; ?></td>
                  <td><?php echo e($applicant->contact); ?></td>
                  <td><?php echo e(Carbon\Carbon::parse($applicant->d_admission)->format('m/d/Y')); ?> : <?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')); ?></td>
                  <td style="text-align:center;">
                    <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="<?php echo e($applicant->id); ?>" data-toggle="modal" data-target="#info_examinee" class="btn btn-green glyphicon glyphicon-tasks info_applicant"></i></a>
                  </td>
                </tr> 
                <?php else: ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </tbody>
          </table>
      </div>
    </div>
<?php $__env->stopSection(); ?>

 <!-- Start Examinee -->
    <div class="modal fade bs-example-modal-sm" id="info_examinee" tabindex="-1" role="dialog" aria-hidden="true">
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
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_examinee"></a> Examinee Data</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-stats" id="btn_test_result"></a> Assign Test Result</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-print" id="btn_view_applicant"></a> Print Examinee Data</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-print" id="btn_view_permit"></a> Print Examinee Permit</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-camera" id="btn_capture_image"></a> Capture Examinee Image</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-check" id="btn_confirm_examinee"></a> Push Examinee</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_examinee"></a> Remove Examinee</p>    
              </div>
            </div>
          </div>
    </div> 
  <!-- End Examinee -->
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admission/examinee/list_search.blade.php ENDPATH**/ ?>