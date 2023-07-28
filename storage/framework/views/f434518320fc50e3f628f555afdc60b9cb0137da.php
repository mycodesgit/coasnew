<?php $__env->startSection('title'); ?>
COAS - V1.0 || Edit Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>


<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li><?php echo e($applicant->admission_id); ?></li>
        <li style="text-transform: uppercase;"><?php echo e($applicant->fname); ?> <?php if($applicant->mname == null): ?> <?php else: ?> <?php echo e(substr($applicant->mname,0,1)); ?>.<?php endif; ?> <?php echo e($applicant->lname); ?>  <?php if($applicant->ext == 'N/A'): ?> <?php else: ?><?php echo e($applicant->ext); ?><?php endif; ?></li>
        <li class="active">Edit Data</li>
    </ol>

  <div class="container-fluid">
<div class="col-md-10 jumbotron">

  <div class="tab-content">
    <div id="appinfo" class="tab-pane fade in active">
         <div class="container-fluid">
    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>

    <form method="POST" action="<?php echo e(route('applicant_update_nd', $applicant->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

      <div class="page-header" style="margin-top: 0px;">
        <h4>Examinee Information</h4>
      </div>
      <div class="col-md-2">
        <label><span class="label label-default">Admission No.</span></label>
        <input type="text" class="form-control" name="admissionid" value="<?php echo e($applicant->admission_id); ?>" disabled>
      </div>
       <div class="col-md-2" <?php echo e(($errors->has('type')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Admission Type</span></label>
        <select class="form-control" name="type">
          <option value="<?php echo e($applicant->type); ?>"><?php if($applicant->type == 1): ?> New <?php elseif($applicant->type == 2): ?> Returnee <?php elseif($applicant->type == 3): ?> Transferee <?php endif; ?></option>
          <option value="1" <?php if(old('type') == 1): ?> <?php echo e('selected'); ?> <?php endif; ?>>New</option>
          <option value="2" <?php if(old('type') == 2): ?> <?php echo e('selected'); ?> <?php endif; ?>>Returnee</option>
          <option value="3" <?php if(old('type') == 3): ?> <?php echo e('selected'); ?> <?php endif; ?>>Transferee</option>
        </select>
        <?php if($errors->has('type')): ?>
        <span class="label label-danger"><?php echo e($errors->first('type')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-3" <?php echo e(($errors->has('lname')) ? 'has-error' : ''); ?>>
          <label><span class="label label-default">Lastname</span></label>
          <input type="text" style="text-transform: uppercase;"  name="lname" class="form-control" value="<?php echo e($applicant->lname); ?>">
      </div>
      <div class="col-md-3">
            <label><span class="label label-default">Firstname</span></label>
            <input type="text" style="text-transform: uppercase;"  name="fname" class="form-control" value="<?php echo e($applicant->fname); ?>">
      </div>
      <div class="col-md-2">
        <label><span class="label label-default">Middlename</span></label>
        <input type="text" style="text-transform: uppercase;"  name="mname" class="form-control" value="<?php echo e($applicant->mname); ?>">
      </div>
      <div class="col-md-2">
      <label><span class="label label-default">Ext.</span></label>
      <select class="form-control" name="ext">
          <option value="<?php echo e($applicant->ext); ?>"><?php if($applicant->ext == ''): ?> N/A <?php elseif($applicant->ext == 'Jr.'): ?> Jr. <?php elseif($applicant->ext == 'Sr.'): ?> Sr. <?php elseif($applicant->ext == 'III'): ?> III <?php elseif($applicant->ext == 'IV'): ?> IV <?php endif; ?></option>
          <?php if($applicant->ext == ''): ?> <?php else: ?> <option value="">N/A</option><?php endif; ?>
          <?php if($applicant->ext == 'Jr.'): ?> <?php else: ?> <option value="Jr.">Jr.</option><?php endif; ?>
          <?php if($applicant->ext == 'Sr.'): ?> <?php else: ?> <option value="Sr.">Sr.</option><?php endif; ?>
          <?php if($applicant->ext == 'III'): ?> <?php else: ?> <option value="III">III</option><?php endif; ?>
          <?php if($applicant->ext == 'IV'): ?> <?php else: ?> <option value="IV">IV</option><?php endif; ?> 
        </select>
      </div>
      <div class="col-md-2" <?php echo e(($errors->has('gender')) ? 'has-error' : ''); ?>>
      <label><span class="label label-default">Gender</span></label>
        <select class="form-control" name="gender">
          <option value="<?php echo e($applicant->gender); ?>"><?php echo e($applicant->gender); ?></option>
          <option value="Male" <?php if(old('gender') == "Male"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Male</option>
          <option value="Female" <?php if(old('gender') == "Female"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Female</option>
        </select>
        <?php if($errors->has('gender')): ?>
        <span class="label label-danger"><?php echo e($errors->first('gender')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-3">
        <label><span class="label label-default">Date of Birth (d/m/y)</span></label>
        <input type="date" class="form-control" name="bday" value="<?php echo e($applicant->bday); ?>">
      </div>
      <div class="col-md-2" <?php echo e(($errors->has('age')) ? 'has-error' : ''); ?>>
      <label><span class="label label-default">Age</span></label>
      <select class="form-control" name="age">
          <option value="<?php echo e($applicant->age); ?>"><?php echo e($applicant->age); ?></option>
          <?php if($applicant->age == '16'): ?> <?php else: ?> <option value="16" <?php if(old('age') == "16"): ?> <?php echo e('selected'); ?> <?php endif; ?>>16</option><?php endif; ?>
          <?php if($applicant->age == '17'): ?> <?php else: ?> <option value="17" <?php if(old('age') == "17"): ?> <?php echo e('selected'); ?> <?php endif; ?>>17</option><?php endif; ?>
          <?php if($applicant->age == '18'): ?> <?php else: ?> <option value="18" <?php if(old('age') == "18"): ?> <?php echo e('selected'); ?> <?php endif; ?>>18</option><?php endif; ?>
          <?php if($applicant->age == '19'): ?> <?php else: ?> <option value="19" <?php if(old('age') == "19"): ?> <?php echo e('selected'); ?> <?php endif; ?>>19</option><?php endif; ?>
          <?php if($applicant->age == '20'): ?> <?php else: ?> <option value="20" <?php if(old('age') == "20"): ?> <?php echo e('selected'); ?> <?php endif; ?>>20</option><?php endif; ?>
          <?php if($applicant->age == '21'): ?> <?php else: ?> <option value="21" <?php if(old('age') == "21"): ?> <?php echo e('selected'); ?> <?php endif; ?>>21</option><?php endif; ?>
          <?php if($applicant->age == '22'): ?> <?php else: ?> <option value="22" <?php if(old('age') == "22"): ?> <?php echo e('selected'); ?> <?php endif; ?>>22</option><?php endif; ?>
          <?php if($applicant->age == '23'): ?> <?php else: ?> <option value="23" <?php if(old('age') == "23"): ?> <?php echo e('selected'); ?> <?php endif; ?>>23</option><?php endif; ?>
          <?php if($applicant->age == '24'): ?> <?php else: ?> <option value="24" <?php if(old('age') == "24"): ?> <?php echo e('selected'); ?> <?php endif; ?>>24</option><?php endif; ?>
          <?php if($applicant->age == '25'): ?> <?php else: ?> <option value="25" <?php if(old('age') == "25"): ?> <?php echo e('selected'); ?> <?php endif; ?>>25</option><?php endif; ?>
          <?php if($applicant->age == '26'): ?> <?php else: ?> <option value="26" <?php if(old('age') == "26"): ?> <?php echo e('selected'); ?> <?php endif; ?>>26</option><?php endif; ?>
          <?php if($applicant->age == '27'): ?> <?php else: ?> <option value="27" <?php if(old('age') == "27"): ?> <?php echo e('selected'); ?> <?php endif; ?>>27</option><?php endif; ?>
          <?php if($applicant->age == '28'): ?> <?php else: ?> <option value="28" <?php if(old('age') == "28"): ?> <?php echo e('selected'); ?> <?php endif; ?>>28</option><?php endif; ?>
          <?php if($applicant->age == '29'): ?> <?php else: ?> <option value="29" <?php if(old('age') == "29"): ?> <?php echo e('selected'); ?> <?php endif; ?>>29</option><?php endif; ?>
          <?php if($applicant->age == '30'): ?> <?php else: ?> <option value="30" <?php if(old('age') == "30"): ?> <?php echo e('selected'); ?> <?php endif; ?>>30</option><?php endif; ?>
          <?php if($applicant->age == '31'): ?> <?php else: ?> <option value="31" <?php if(old('age') == "31"): ?> <?php echo e('selected'); ?> <?php endif; ?>>31</option><?php endif; ?>
          <?php if($applicant->age == '32'): ?> <?php else: ?> <option value="32" <?php if(old('age') == "32"): ?> <?php echo e('selected'); ?> <?php endif; ?>>32</option><?php endif; ?>
          <?php if($applicant->age == '33'): ?> <?php else: ?> <option value="33" <?php if(old('age') == "33"): ?> <?php echo e('selected'); ?> <?php endif; ?>>33</option><?php endif; ?>
          <?php if($applicant->age == '34'): ?> <?php else: ?> <option value="34" <?php if(old('age') == "34"): ?> <?php echo e('selected'); ?> <?php endif; ?>>34</option><?php endif; ?>
          <?php if($applicant->age == '35'): ?> <?php else: ?> <option value="35" <?php if(old('age') == "35"): ?> <?php echo e('selected'); ?> <?php endif; ?>>35</option><?php endif; ?>
          <?php if($applicant->age == '36'): ?> <?php else: ?> <option value="36" <?php if(old('age') == "36"): ?> <?php echo e('selected'); ?> <?php endif; ?>>36</option><?php endif; ?>
          <?php if($applicant->age == '37'): ?> <?php else: ?> <option value="37" <?php if(old('age') == "37"): ?> <?php echo e('selected'); ?> <?php endif; ?>>37</option><?php endif; ?>
          <?php if($applicant->age == '38'): ?> <?php else: ?> <option value="38" <?php if(old('age') == "38"): ?> <?php echo e('selected'); ?> <?php endif; ?>>38</option><?php endif; ?>
          <?php if($applicant->age == '39'): ?> <?php else: ?> <option value="39" <?php if(old('age') == "39"): ?> <?php echo e('selected'); ?> <?php endif; ?>>39</option><?php endif; ?>
          <?php if($applicant->age == '40'): ?> <?php else: ?> <option value="40" <?php if(old('age') == "40"): ?> <?php echo e('selected'); ?> <?php endif; ?>>40</option><?php endif; ?>
          <?php if($applicant->age == '41'): ?> <?php else: ?> <option value="41" <?php if(old('age') == "41"): ?> <?php echo e('selected'); ?> <?php endif; ?>>41</option><?php endif; ?>
          <?php if($applicant->age == '42'): ?> <?php else: ?> <option value="42" <?php if(old('age') == "42"): ?> <?php echo e('selected'); ?> <?php endif; ?>>42</option><?php endif; ?>
          <?php if($applicant->age == '43'): ?> <?php else: ?> <option value="43" <?php if(old('age') == "43"): ?> <?php echo e('selected'); ?> <?php endif; ?>>43</option><?php endif; ?>
          <?php if($applicant->age == '44'): ?> <?php else: ?> <option value="44" <?php if(old('age') == "44"): ?> <?php echo e('selected'); ?> <?php endif; ?>>44</option><?php endif; ?>
          <?php if($applicant->age == '45'): ?> <?php else: ?> <option value="45" <?php if(old('age') == "45"): ?> <?php echo e('selected'); ?> <?php endif; ?>>45</option><?php endif; ?>
          <?php if($applicant->age == '46'): ?> <?php else: ?> <option value="46" <?php if(old('age') == "46"): ?> <?php echo e('selected'); ?> <?php endif; ?>>46</option><?php endif; ?>
          <?php if($applicant->age == '47'): ?> <?php else: ?> <option value="47" <?php if(old('age') == "47"): ?> <?php echo e('selected'); ?> <?php endif; ?>>47</option><?php endif; ?>
          <?php if($applicant->age == '48'): ?> <?php else: ?> <option value="48" <?php if(old('age') == "48"): ?> <?php echo e('selected'); ?> <?php endif; ?>>48</option><?php endif; ?>
          <?php if($applicant->age == '49'): ?> <?php else: ?> <option value="49" <?php if(old('age') == "49"): ?> <?php echo e('selected'); ?> <?php endif; ?>>49</option><?php endif; ?>
          <?php if($applicant->age == '50'): ?> <?php else: ?> <option value="50" <?php if(old('age') == "50"): ?> <?php echo e('selected'); ?> <?php endif; ?>>50</option><?php endif; ?>
        </select>
        <?php if($errors->has('age')): ?>
        <span class="label label-danger"><?php echo e($errors->first('age')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-3">
        <label><span class="label label-default">Contact #</span></label>
        <input type="tel" class="form-control" name="contact" value="<?php echo e($applicant->contact); ?>">
      </div>
      <div class="col-md-4">
        <label><span class="label label-default">Email Address</span></label>
        <input type="email" class="form-control" name="email" value="<?php echo e($applicant->email); ?>"/>
      </div>
      <div class="col-md-8" <?php echo e(($errors->has('address')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Address</span></label>
        <input type="text" name="address" class="form-control" value="<?php echo e($applicant->address); ?>" style="text-transform: uppercase;">
        <?php if($errors->has('address')): ?>
        <span class="label label-danger"><?php echo e($errors->first('address')); ?></span>
        <?php endif; ?>
      </div>

      <div class="container-fluid">
      </div>

      <div class="page-header" style="margin-top: 0px;">
        <h4>For New Student <span style="font-size: 10px;color:#ff0000;">(Input for New Applicant only)</span></h4>
      </div>

      <div class="col-md-6">
        <label><span class="label label-default">Last School Attended</span></label>
        <input type="text" style="text-transform: uppercase;" name="lstsch_attended" class="form-control" value="<?php echo e($applicant->lstsch_attended); ?>">
      </div>

      <div class="col-md-6">
        <label><span class="label label-default">Strand</span></label>
        <select class="level form-control" name="strand" style="text-transform: uppercase;">
        <option value="<?php echo e($applicant->strand); ?>"><?php if($applicant->strand == 'BAM'): ?> Accountancy, Business, & Management (ABM) <?php elseif($applicant->strand == 'GAS'): ?> General Academic Strand (GAS) <?php elseif($applicant->strand == 'HUMSS'): ?> Humanities, Education, Social Sciences (HUMSS) <?php elseif($applicant->strand == 'STEM'): ?> Science, Technology, Engineering, & Mathematics (STEM) <?php elseif($applicant->strand == 'TVL-CHF'): ?> TVL - Cookery, Home Economics, & FBS (TVL-CHF) <?php elseif($applicant->strand == 'TVL-CIV'): ?> TVL - CSS, ICT, & VGD (TVL-CIV) <?php elseif($applicant->strand == 'TVL-AFA'): ?> TVL - Agricultural & Fisheries Arts (TVL-AFA) <?php elseif($applicant->strand == 'TVL-EIM'): ?> TVL - Electrical Installation & Maintenance (TVL-EIM) <?php elseif($applicant->strand == 'TVL-SMAW'): ?> TVL - Shielded Metal Arc Welding (TVL-SMAW) <?php elseif($applicant->strand == 'OLD'): ?> Old Curriculum <?php endif; ?></option>
        <?php $__currentLoopData = $strand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($strand->code); ?>" <?php if(old('strand') == "<?php echo e($strand->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($strand->strand); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      </div>

      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
          <h4>For Transferee <span style="font-size: 10px;color:#ff0000;">(Input for Transferee only)</span></h4>
      </div>

      <div class="col-md-6">
        <label><span class="label label-default">College/University last attended</span></label>
        <input type="text" style="text-transform: uppercase;" name="suc_lst_attended" class="form-control" value="<?php echo e($applicant->suc_lst_attended); ?>">
      </div>

      <div class="col-md-6" <?php echo e(($errors->has('course')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Course</span></label>
        <select class="form-control" name="course" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->course); ?>"><?php echo e($applicant->course); ?></option>
          <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($programs->code); ?>" <?php if(old('course') == "<?php echo e($programs->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($programs->program); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('course')): ?>
        <span class="label label-danger"><?php echo e($errors->first('course')); ?></span>
        <?php endif; ?>
      </div>

      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
        <h4>Course Preferences</h4>
      </div>

      <div class="col-md-12">
        <label><span class="label label-default">Course Preference #1</span></label>
        <select class="form-control" name="preference_1" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->preference_1); ?>"><?php echo e($applicant->preference_1); ?></option>
          <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($programs->code); ?>" <?php if(old('preference_1') == "<?php echo e($programs->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($programs->program); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="col-md-12">
        <label><span class="label label-default">Course Preference #2</span></label>
        <select class="form-control" name="preference_2" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->preference_2); ?>"><?php echo e($applicant->preference_2); ?></option>
          <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($programs->code); ?>" <?php if(old('preference_2') == "<?php echo e($programs->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($programs->program); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
          <h4>Schedule of Examination</h4>
      </div>
       <div class="col-md-4">
        <label><span class="label label-default">Date of Admission Test</span></label>
        <select class="form-control" name="d_admission" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->d_admission); ?>"><?php echo e($applicant->d_admission); ?></option>
          <?php $__currentLoopData = $date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($date->date); ?>" <?php if(old('d_admission') == "<?php echo e($date->date); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($date->date); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-md-4">
        <label><span class="label label-default">Time</span></label>
        <select class="form-control" name="time" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->time); ?>"><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')); ?></option>
          <?php $__currentLoopData = $time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($time->time); ?>" <?php if(old('time') == "<?php echo e($time->time); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-md-4">
        <label><span class="label label-default">Venue</span></label>
        <select class="form-control" name="venue" style="text-transform: uppercase;">
          <option value="<?php echo e($applicant->venue); ?>"><?php echo e($applicant->venue); ?></option>
          <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($venue->venue); ?>" <?php if(old('venue') == "<?php echo e($venue->venue); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($venue->venue); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
          <h4>Available Documents</h4>
      </div>

      <div class="row">
        <div class="container-fluid">
            <div class="col-md-12">
                <input type="radio" name="r_card" value="Yes" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('r_card', $doc->r_card) === 'Yes' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> Yes
                <input type="radio" name="r_card" value="No" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('r_card', $doc->r_card) === 'No' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> No
              <label>| Report Card</label>
            </div>
            <div class="col-md-12">
                <input type="radio" name="g_moral" value="Yes" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('g_moral', $doc->g_moral) === 'Yes' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> Yes
                <input type="radio" name="g_moral" value="No" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('g_moral', $doc->g_moral) === 'No' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> No
              <label>| Certificate of Good Moral</label>
            </div>
            <div class="col-md-12">
                <input type="radio" name="b_cert" value="Yes" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('b_cert', $doc->b_cert) === 'Yes' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> Yes
                <input type="radio" name="b_cert" value="No" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('b_cert', $doc->b_cert) === 'No' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> No
              <label>| Birth Certificate</label>
            </div>
            <div class="col-md-12">
                <input type="radio" name="m_cert" value="Yes" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('m_cert', $doc->m_cert) === 'Yes' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> Yes
                <input type="radio" name="m_cert" value="No" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('m_cert', $doc->m_cert) === 'No' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> No
              <label>| Medical Certificate</label>
            </div>
            <div class="col-md-12">
                <input type="radio" name="t_record" value="Yes" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('t_record', $doc->t_record) === 'Yes' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> Yes
                <input type="radio" name="t_record" value="No" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('t_record', $doc->t_record) === 'No' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> No
              <label>| Transcript of Record (For transferees)</label>
            </div>
            <div class="col-md-12">
                <input type="radio" name="h_dismissal" value="Yes" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('h_dismissal', $doc->h_dismissal) === 'Yes' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> Yes
                <input type="radio" name="h_dismissal" value="No" <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(old('h_dismissal', $doc->h_dismissal) === 'No' ? 'checked' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>> No
              <label>| Honorable Dismissal (For transferees)</label>
            </div>
          </div>
        </div>

        <div class="modal-footer text-center">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-green-save glyphicon glyphicon-saved"></button>
              <button type="reset" class="btn btn-danger glyphicon glyphicon-repeat"></button>
            </div>
        </div>
    </form>
    </div>
    </div>
  </div>



    <div id="printAppForm" class="tab-pane fade">
      <div class="page-header" style="margin-top: 0px;">
        <h4>Print/Download Data</h4>
      </div>
      <div class="container-fluid">
        <div class="row">
            <iframe src="<?php echo e(route('applicant_genPDF', $applicant->id)); ?>" width="100%" height="800"></iframe>
        </div>
      </div>
    </div>


    <div id="appImage" class="tab-pane fade">
      <div class="page-header" style="margin-top: 0px;">
        <h4>Capture Image</h4>
      </div>
      <div class="container-fluid">
        <div class="row">
        <form method="POST" action="<?php echo e(route('applicant_save_image', $applicant->id)); ?>">
        <?php echo csrf_field(); ?>
        <div class="row col-md-6">
          <label>Camera</label>
          <div id="coas_camera" class="coas_camera"></div>
          <input type=button class="capture_snapshot btn btn-green" value="Capture Snapshot" onClick="capture_snapshot()">
          <input type="hidden" name="image" class="image-tag">
      </div>
      
      <div class="row col-md-6">
        <label>Result</label>
        <div id="results" class="coas_camera_result"></div>
        <?php echo e(csrf_field()); ?>

        <button type="submit" class="capture_snapshot btn btn-green-save glyphicon glyphicon-saved"></button>
      </div>
      </form>
      </div>
      </div>
    </div>

     <div id="testresult" class="tab-pane fade">
        <div class="container-fluid">
          <form method="POST" action="<?php echo e(route('examinee_result_save_nd', $applicant->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
          
          <div class="container-fluid">
          </div>

          <div class="page-header" style="margin-top: 0px;">
            <h4>Assign Result</h4>
          </div>
           <div class="col-md-offset-2 col-md-4">
            <label><span class="label label-default">Raw Score</span></label>
            <input type="text" class="form-control" name="raw_score" value="<?php echo e($applicant->result->raw_score); ?>">
          </div>
          <div class="col-md-4">
            <label><span class="label label-default">Precentile</span></label>
            <input type="text" class="form-control" name="percentile" value="<?php echo e($applicant->result->percentile); ?>">
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

     <div id="appPushResult" class="tab-pane fade">
      <div class="page-header" style="margin-top: 0px;">
        <h4>Push Examinee</h4>
      </div>
        <div class="container-fluid">
          <div class="row text-center">
              <p><a href="<?php echo e(route('examinee_confirm', $applicant->id)); ?>" type="button" class="btn btn-green-save glyphicon glyphicon-check"></a> Push to Results</p> 
          </div>
        </div>
      </div>
  </div>
</div>

  <div class="col-md-2">
    <div class="page-header" style="margin-top: 0px;">
      <h4>Menu</h4>
    </div>
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a data-toggle="tab" href="#appinfo" style="color:#008000;">Information</a></li>
      <li><a data-toggle="tab" href="#testresult" style="color:#008000;">Test Result</a></li>
      <li><a data-toggle="tab" href="#printAppForm" style="color:#008000;">View/Print</a></li>
      <li><a data-toggle="tab" href="#appImage" style="color:#008000;">Capture Image</a></li>
      <li><a data-toggle="tab" href="#appPushResult" style="color:#008000;">Push to Results</a></li>
    </ul>
  </div>

  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('bootstrap/js/webcam.min.js')); ?>"></script>   
<script language="JavaScript">
     Webcam.set({
         width: 320,
         height: 240,
         image_format: 'jpeg',
         jpeg_quality: 90
     });
    Webcam.attach('#coas_camera');

    function capture_snapshot() {
       Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        });
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u841447435/domains/cpsucoas.com/public_html/resources/views/admission/examinee/edit.blade.php ENDPATH**/ ?>