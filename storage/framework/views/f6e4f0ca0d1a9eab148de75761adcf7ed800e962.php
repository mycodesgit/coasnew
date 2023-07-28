<?php $__env->startSection('title'); ?>
COAS - V1.0 || Add Applicant
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sideheader'); ?>
<h4>Admission</h4>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('sidemenu'); ?>

<?php $__env->startSection('workspace'); ?>
    <ol class="breadcrumb">
        <li class="active"><a href="<?php echo e(route('home')); ?>" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li class="active">Add Applicant</li>
    </ol>
    <div class="container-fluid">
    <div class="row">
    <p><?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
      <?php elseif(Session::has('fail')): ?>
        <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>  
    <?php endif; ?></p>

    <form method="post" action="<?php echo e(route('post-applicant-add')); ?>" enctype="multipart/form-data">
      <?php echo e(csrf_field()); ?>

      <div class="page-header" style="margin-top: 0px;">
        <h4>Applicant Information</h4>
      </div>

      <div class="col-md-2">
        <label><span class="label label-default">Admission No.</span></label>
        <input type="text" class="form-control" name="admissionid" value="<?php echo e(2023 . (rand(00000,99999))); ?>">
      </div>

      <div class="col-md-2" <?php echo e(($errors->has('type')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Admission Type</span></label>
        <select class="form-control" name="type">
          <option value="">Select</option>
          <option value="1" <?php if(old('type') == 1): ?> <?php echo e('selected'); ?> <?php endif; ?>>New</option>
          <option value="2" <?php if(old('type') == 2): ?> <?php echo e('selected'); ?> <?php endif; ?>>Returnee</option>
          <option value="3" <?php if(old('type') == 3): ?> <?php echo e('selected'); ?> <?php endif; ?>>Transferee</option>
        </select>
        <?php if($errors->has('type')): ?>
        <span class="label label-danger"><?php echo e($errors->first('type')); ?></span>
        <?php endif; ?>
      </div>

      <div class="col-md-3" <?php echo e(($errors->has('lastname')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Lastname</span></label>
        <input type="text" style="text-transform: uppercase;"  name="lastname" class="form-control" value="<?php echo e(old('lastname')); ?>">
        <?php if($errors->has('lastname')): ?>
        <span class="label label-danger"><?php echo e($errors->first('lastname')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-3" <?php echo e(($errors->has('firstname')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Firstname</span></label>
        <input type="text" style="text-transform: uppercase;"  name="firstname" class="form-control" value="<?php echo e(old('firstname')); ?>">
        <?php if($errors->has('firstname')): ?>
        <span class="label label-danger"><?php echo e($errors->first('firstname')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-2">
        <label><span class="label label-default">Middlename</span></label>
        <input type="text" style="text-transform: uppercase;"  name="mname" class="form-control" value="<?php echo e(old('mname')); ?>">
      </div>
      <div class="col-md-2">
      <label><span class="label label-default">Ext.</span></label>
        <select class="form-control" name="ext">
          <option>N/A</option>
          <option value="Jr." <?php if(old('ext') == "Jr."): ?> <?php echo e('selected'); ?> <?php endif; ?>>Jr.</option>
          <option value="Sr." <?php if(old('ext') == "Sr."): ?> <?php echo e('selected'); ?> <?php endif; ?>>Sr.</option>
          <option value="III" <?php if(old('ext') == "III"): ?> <?php echo e('selected'); ?> <?php endif; ?>>III</option>
          <option value="IV" <?php if(old('ext') == "IV"): ?> <?php echo e('selected'); ?> <?php endif; ?>>IV</option>  
        </select>
      </div>

      <div class="col-md-2" <?php echo e(($errors->has('gender')) ? 'has-error' : ''); ?>>
      <label><span class="label label-default">Gender</span></label>
      <select class="form-control" name="gender">
          <option value="">Select</option>
          <option value="Male" <?php if(old('gender') == "Male"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Male</option>
          <option value="Female" <?php if(old('gender') == "Female"): ?> <?php echo e('selected'); ?> <?php endif; ?>>Female</option>
        </select>
        <?php if($errors->has('gender')): ?>
        <span class="label label-danger"><?php echo e($errors->first('gender')); ?></span>
        <?php endif; ?>
      </div>

      <div class="col-md-2">
        <label><span class="label label-default">Date of Birth</span></label>
        <input type="date" class="form-control" name="bday" value="<?php echo e(old('bday')); ?>">
      </div>
      <div class="col-md-2" <?php echo e(($errors->has('age')) ? 'has-error' : ''); ?>>
      <label><span class="label label-default">Age</span></label>
      <select class="form-control" name="age">
          <option value="">Select</option>
          <option value="16" <?php if(old('age') == "16"): ?> <?php echo e('selected'); ?> <?php endif; ?>>16</option>
          <option value="17" <?php if(old('age') == "17"): ?> <?php echo e('selected'); ?> <?php endif; ?>>17</option>
          <option value="18" <?php if(old('age') == "18"): ?> <?php echo e('selected'); ?> <?php endif; ?>>18</option>
          <option value="19" <?php if(old('age') == "19"): ?> <?php echo e('selected'); ?> <?php endif; ?>>19</option>
          <option value="20" <?php if(old('age') == "20"): ?> <?php echo e('selected'); ?> <?php endif; ?>>20</option>
          <option value="21" <?php if(old('age') == "21"): ?> <?php echo e('selected'); ?> <?php endif; ?>>21</option>
          <option value="22" <?php if(old('age') == "22"): ?> <?php echo e('selected'); ?> <?php endif; ?>>22</option>
          <option value="23" <?php if(old('age') == "23"): ?> <?php echo e('selected'); ?> <?php endif; ?>>23</option>
          <option value="24" <?php if(old('age') == "24"): ?> <?php echo e('selected'); ?> <?php endif; ?>>24</option>
          <option value="25" <?php if(old('age') == "25"): ?> <?php echo e('selected'); ?> <?php endif; ?>>25</option>
          <option value="26" <?php if(old('age') == "26"): ?> <?php echo e('selected'); ?> <?php endif; ?>>26</option>
          <option value="27" <?php if(old('age') == "27"): ?> <?php echo e('selected'); ?> <?php endif; ?>>27</option>
          <option value="28" <?php if(old('age') == "28"): ?> <?php echo e('selected'); ?> <?php endif; ?>>28</option>
          <option value="29" <?php if(old('age') == "29"): ?> <?php echo e('selected'); ?> <?php endif; ?>>29</option>
          <option value="30" <?php if(old('age') == "30"): ?> <?php echo e('selected'); ?> <?php endif; ?>>30</option>
          <option value="31" <?php if(old('age') == "31"): ?> <?php echo e('selected'); ?> <?php endif; ?>>31</option>
          <option value="32" <?php if(old('age') == "32"): ?> <?php echo e('selected'); ?> <?php endif; ?>>32</option>
          <option value="33" <?php if(old('age') == "33"): ?> <?php echo e('selected'); ?> <?php endif; ?>>33</option>
          <option value="34" <?php if(old('age') == "34"): ?> <?php echo e('selected'); ?> <?php endif; ?>>34</option>
          <option value="35" <?php if(old('age') == "35"): ?> <?php echo e('selected'); ?> <?php endif; ?>>35</option>
          <option value="36" <?php if(old('age') == "36"): ?> <?php echo e('selected'); ?> <?php endif; ?>>36</option>
          <option value="37" <?php if(old('age') == "37"): ?> <?php echo e('selected'); ?> <?php endif; ?>>37</option>
          <option value="38" <?php if(old('age') == "38"): ?> <?php echo e('selected'); ?> <?php endif; ?>>38</option>
          <option value="39" <?php if(old('age') == "39"): ?> <?php echo e('selected'); ?> <?php endif; ?>>39</option>
          <option value="40" <?php if(old('age') == "40"): ?> <?php echo e('selected'); ?> <?php endif; ?>>40</option>
          <option value="41" <?php if(old('age') == "41"): ?> <?php echo e('selected'); ?> <?php endif; ?>>41</option>
          <option value="42" <?php if(old('age') == "42"): ?> <?php echo e('selected'); ?> <?php endif; ?>>42</option>
          <option value="43" <?php if(old('age') == "43"): ?> <?php echo e('selected'); ?> <?php endif; ?>>43</option>
          <option value="44" <?php if(old('age') == "44"): ?> <?php echo e('selected'); ?> <?php endif; ?>>44</option>
          <option value="45" <?php if(old('age') == "45"): ?> <?php echo e('selected'); ?> <?php endif; ?>>45</option>
          <option value="46" <?php if(old('age') == "46"): ?> <?php echo e('selected'); ?> <?php endif; ?>>46</option>
          <option value="47" <?php if(old('age') == "47"): ?> <?php echo e('selected'); ?> <?php endif; ?>>47</option>
          <option value="48" <?php if(old('age') == "48"): ?> <?php echo e('selected'); ?> <?php endif; ?>>48</option>
          <option value="49" <?php if(old('age') == "49"): ?> <?php echo e('selected'); ?> <?php endif; ?>>49</option>
          <option value="50" <?php if(old('age') == "46"): ?> <?php echo e('selected'); ?> <?php endif; ?>>50</option>
          <option value="51" <?php if(old('age') == "51"): ?> <?php echo e('selected'); ?> <?php endif; ?>>51</option>
          <option value="52" <?php if(old('age') == "52"): ?> <?php echo e('selected'); ?> <?php endif; ?>>52</option>
          <option value="53" <?php if(old('age') == "53"): ?> <?php echo e('selected'); ?> <?php endif; ?>>53</option>
          <option value="54" <?php if(old('age') == "54"): ?> <?php echo e('selected'); ?> <?php endif; ?>>54</option>
          <option value="55" <?php if(old('age') == "55"): ?> <?php echo e('selected'); ?> <?php endif; ?>>55</option>
          <option value="56" <?php if(old('age') == "56"): ?> <?php echo e('selected'); ?> <?php endif; ?>>56</option>
          <option value="57" <?php if(old('age') == "57"): ?> <?php echo e('selected'); ?> <?php endif; ?>>57</option>
          <option value="58" <?php if(old('age') == "58"): ?> <?php echo e('selected'); ?> <?php endif; ?>>58</option>
          <option value="59" <?php if(old('age') == "59"): ?> <?php echo e('selected'); ?> <?php endif; ?>>59</option>
          <option value="60" <?php if(old('age') == "46"): ?> <?php echo e('selected'); ?> <?php endif; ?>>60</option>
        </select>
        <?php if($errors->has('age')): ?>
        <span class="label label-danger"><?php echo e($errors->first('age')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-2" <?php echo e(($errors->has('contact')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Mobile #</span></label>
        <input type="text" class="form-control" name="contact" placeholder="mobile #" value="<?php echo e(old('contact')); ?>">
        <?php if($errors->has('contact')): ?>
        <span class="label label-danger"><?php echo e($errors->first('contact')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-2" <?php echo e(($errors->has('email')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Email Address</span></label>
        <input type="email" class="form-control" name="email" placeholder="e.g john@gmail.com" value="<?php echo e(old('email')); ?>"/>
        <?php if($errors->has('email')): ?>
        <span class="label label-danger"><?php echo e($errors->first('email')); ?></span>
        <?php endif; ?>
      </div>
      <div class="col-md-12" <?php echo e(($errors->has('address')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Address</span></label>
        <input type="text" name="address" class="form-control" placeholder="Present Address" value="<?php echo e(old('address')); ?>" style="text-transform: uppercase;">
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
        <input type="text" style="text-transform: uppercase;" name="lstsch_attended" class="form-control" value="<?php echo e(old('lstsch_attended')); ?>">
      </div>
      <div class="col-md-6" <?php echo e(($errors->has('strand')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Strand</span></label>
        <select class="level form-control" name="strand" style="text-transform: uppercase;">
        <option value="">Select</option>
          <?php $__currentLoopData = $strand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($strand->code); ?>" <?php if(old('strand') == "<?php echo e($strand->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($strand->strand); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php if($errors->has('strand')): ?>
      <span class="label label-danger"><?php echo e($errors->first('strand')); ?></span>
      <?php endif; ?>
      </div>
      
      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
          <h4>For Transferee <span style="font-size: 10px;color:#ff0000;">(Input for Transferee only)</span></h4>
      </div>

      <div class="col-md-6">
        <label><span class="label label-default">College/University last attended<span></label>
        <input type="text" style="text-transform: uppercase;" name="suc_lst_attended" class="form-control" value="<?php echo e(old('suc_lst_attended')); ?>">
      </div>

       <div class="col-md-6" <?php echo e(($errors->has('course')) ? 'has-error' : ''); ?>>
        <label><span class="label label-default">Course</span></label>
        <select class="form-control" name="course" style="text-transform: uppercase;">
          <option value="">Select Course</option>
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
          <div class="col-md-12" <?php echo e(($errors->has('preference_1')) ? 'has-error' : ''); ?>>
            <label><span class="label label-default">Course Preference #1</span></label>
            <select class="form-control" name="preference_1" style="text-transform: uppercase;">
              <option value="">Select Course Preference</option>
              <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($programs->code); ?>" <?php if(old('course') == "<?php echo e($programs->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($programs->program); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('preference_1')): ?>
            <span class="label label-danger"><?php echo e($errors->first('preference_1')); ?></span>
            <?php endif; ?>
          </div>
          <div class="col-md-12" <?php echo e(($errors->has('preference_2')) ? 'has-error' : ''); ?>>
            <label><span class="label label-default">Course Preference #2</span></label>
            <select class="form-control" name="preference_2" style="text-transform: uppercase;">
              <option value="">Select Course Preference</option>
              <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($programs->code); ?>" <?php if(old('course') == "<?php echo e($programs->code); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($programs->program); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('preference_2')): ?>
            <span class="label label-danger"><?php echo e($errors->first('preference_2')); ?></span>
            <?php endif; ?>
          </div>
     
      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
          <h4>Schedule of Examination</h4>
      </div>
      <div class="col-md-4">
        <label><span class="label label-default">Date of Admission Test</span></label>
        <select class="form-control" name="d_admission" style="text-transform: uppercase;">
          <option value="">Select Date</option>
          <?php $__currentLoopData = $date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($date->date); ?>" <?php if(old('d_admission') == "<?php echo e($date->date); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($date->date); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-md-3">
        <label><span class="label label-default">Time</span></label>
        <select class="form-control" name="time">
          <option value="">N/A</option>
          <?php $__currentLoopData = $time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($time->time); ?>" <?php if(old('time') == "<?php echo e($time->time); ?>"): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e(\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
        </select>
      </div>
      
      <div class="col-md-4">
        <label><span class="label label-default">Venue</span></label>
        <select class="form-control" name="venue" style="text-transform: uppercase;">
          <option value="">Select Venue</option>
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
            <input type="radio" name="r_card" value="Yes"> Yes
            <input type="radio" name="r_card" value="No"> No
          <label>| Report Card</label>
        </div>
        <div class="col-md-12">
            <input type="radio" name="g_moral" value="Yes"> Yes
            <input type="radio" name="g_moral" value="No"> No
          <label>| Certificate of Good Moral</label>
        </div>
        <div class="col-md-12">
            <input type="radio" name="b_cert" value="Yes"> Yes
            <input type="radio" name="b_cert" value="No"> No
          <label>| Birth Certificate</label>
        </div>
        <div class="col-md-12">
            <input type="radio" name="m_cert" value="Yes"> Yes
            <input type="radio" name="m_cert" value="No"> No
          <label>| Medical Certificate</label>
        </div>
        <div class="col-md-12">
            <input type="radio" name="t_record" value="Yes"> Yes
            <input type="radio" name="t_record" value="No"> No
          <label>| Transcript of Record (For transferees)</label>
        </div>
        <div class="col-md-12">
            <input type="radio" name="h_dismissal" value="Yes"> Yes
            <input type="radio" name="h_dismissal" value="No"> No
          <label>| Honorable Dismissal (For transferees)</label>
        </div>
      </div>
        
        <div class="col-md-12">
            <div class="text-center">
              <button type="submit" class="btn btn-green-save glyphicon glyphicon-saved"></button>
              <button type="reset" class="btn btn-danger glyphicon glyphicon-repeat"></button>
            </div>
        </div>
      </div>
    </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_admission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u841447435/domains/cpsucoas.com/public_html/resources/views/admission/applicant/add.blade.php ENDPATH**/ ?>