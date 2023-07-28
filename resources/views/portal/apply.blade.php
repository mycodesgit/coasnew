<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('coas-style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('dist/img/logo.png')}}">
    <title>COAS - V1.0 || Apply Admission</title>
  </head>

  @section('style')
    <style type="text/css">
    .tableFixHead {overflow-y: auto;height: 700px;}
    .tableFixHead thead th {position: relative;top: 0px;}
    th,td {padding: 8px 16px;border: 1px solid #ccc;}
    th {background: #eee;}
    .dataTables_filter {float: center !important;margin-top: -50px;}
    .dateFilter{position:absolute;font-size: 10px;color:#d9534f;}
    </style>
  @show

  <body>
 
    <nav class="navbar-default navbar-fixed-top">
      <a class="navbar-brand" href="#">COAS V.1.0</a>
      <div class="navbar-header navbar-fixed-top text-center">
          <img src="{{asset('dist/img/logo.png')}}" style="width:100px;">
      </div>
    </nav>

    <div class="container-fluid" style="margin-top: 65px;">

    <div class="col-md-offset-1 col-md-9 jumbotron" style="background-color: #fff;">
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admission-portal') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li class="active">Apply Admission</li>
    </ol>

    <p>@if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
      @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>  
    @endif</p>

    <form method="post" action="post_admission_apply" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="page-header" style="margin-top: 0px;">
        <h4>Applicant Information</h4>
      </div>

      <div class="col-md-2">
        <label><span class="label label-default">Admission No.</span></label>
        <input type="text" class="form-control" name="admissionid" value="{{ 2023 . (rand(00000,99999)) }}">
      </div>

      <div class="col-md-2" {{ ($errors->has('type')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Admission Type</span></label>
        <select class="form-control" name="type">
          <option value="">Select</option>
          <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>New</option>
          <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>Returnee</option>
          <option value="3" @if (old('type') == 3) {{ 'selected' }} @endif>Transferee</option>
        </select>
        @if ($errors->has('type'))
        <span class="label label-danger">{{ $errors->first('type') }}</span>
        @endif
      </div>

      <div class="col-md-2" {{ ($errors->has('type')) ? 'has-error' : ''}}>
         <label><span class="label label-default">Preferred Campus</span></label>
          <select class="form-control" name="campus">
          <option value="MC" @if (old('type') == 'MC') {{ 'selected' }} @endif>Main</option>
        </select>
      </div>

      <div class="col-md-3" {{ ($errors->has('lastname')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Lastname</span></label>
        <input type="text" style="text-transform: uppercase;"  name="lastname" class="form-control" value="{{old('lastname')}}">
        @if ($errors->has('lastname'))
        <span class="label label-danger">{{ $errors->first('lastname') }}</span>
        @endif
      </div>
      <div class="col-md-3" {{ ($errors->has('firstname')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Firstname</span></label>
        <input type="text" style="text-transform: uppercase;"  name="firstname" class="form-control" value="{{old('firstname')}}">
        @if ($errors->has('firstname'))
        <span class="label label-danger">{{ $errors->first('firstname') }}</span>
        @endif
      </div>
      <div class="col-md-2">
        <label><span class="label label-default">Middlename</span></label>
        <input type="text" style="text-transform: uppercase;"  name="mname" class="form-control" value="{{old('mname')}}">
      </div>
      <div class="col-md-2">
      <label><span class="label label-default">Ext.</span></label>
      <select class="form-control" name="ext">
          <option>N/A</option>
          <option value="Jr." @if (old('ext') == "Jr.") {{ 'selected' }} @endif>Jr.</option>
          <option value="Sr." @if (old('ext') == "Sr.") {{ 'selected' }} @endif>Sr.</option>
          <option value="III" @if (old('ext') == "III") {{ 'selected' }} @endif>III</option>
          <option value="IV" @if (old('ext') == "IV") {{ 'selected' }} @endif>IV</option>  
        </select>
      </div>

      <div class="col-md-2" {{ ($errors->has('gender')) ? 'has-error' : ''}}>
      <label><span class="label label-default">Gender</span></label>
      <select class="form-control" name="gender">
          <option value="">Select</option>
          <option value="Male" @if (old('gender') == "Male") {{ 'selected' }} @endif>Male</option>
          <option value="Female" @if (old('gender') == "Female") {{ 'selected' }} @endif>Female</option>
        </select>
        @if ($errors->has('gender'))
        <span class="label label-danger">{{ $errors->first('gender') }}</span>
        @endif
      </div>

      <div class="col-md-2">
        <label><span class="label label-default">Date of Birth</span></label>
        <input type="date" class="form-control" name="bday" value="{{old('bday')}}">
      </div>
      <div class="col-md-2" {{ ($errors->has('age')) ? 'has-error' : ''}}>
      <label><span class="label label-default">Age</span></label>
      <select class="form-control" name="age">
          <option value="">Select</option>
          <option value="16" @if (old('age') == "16") {{ 'selected' }} @endif>16</option>
          <option value="17" @if (old('age') == "17") {{ 'selected' }} @endif>17</option>
          <option value="18" @if (old('age') == "18") {{ 'selected' }} @endif>18</option>
          <option value="19" @if (old('age') == "19") {{ 'selected' }} @endif>19</option>
          <option value="20" @if (old('age') == "20") {{ 'selected' }} @endif>20</option>
          <option value="21" @if (old('age') == "21") {{ 'selected' }} @endif>21</option>
          <option value="22" @if (old('age') == "22") {{ 'selected' }} @endif>22</option>
          <option value="23" @if (old('age') == "23") {{ 'selected' }} @endif>23</option>
          <option value="24" @if (old('age') == "24") {{ 'selected' }} @endif>24</option>
          <option value="25" @if (old('age') == "25") {{ 'selected' }} @endif>25</option>
          <option value="26" @if (old('age') == "26") {{ 'selected' }} @endif>26</option>
          <option value="27" @if (old('age') == "27") {{ 'selected' }} @endif>27</option>
          <option value="28" @if (old('age') == "28") {{ 'selected' }} @endif>28</option>
          <option value="29" @if (old('age') == "29") {{ 'selected' }} @endif>29</option>
          <option value="30" @if (old('age') == "30") {{ 'selected' }} @endif>30</option>
          <option value="31" @if (old('age') == "31") {{ 'selected' }} @endif>31</option>
          <option value="32" @if (old('age') == "32") {{ 'selected' }} @endif>32</option>
          <option value="33" @if (old('age') == "33") {{ 'selected' }} @endif>33</option>
          <option value="34" @if (old('age') == "34") {{ 'selected' }} @endif>34</option>
          <option value="35" @if (old('age') == "35") {{ 'selected' }} @endif>35</option>
          <option value="36" @if (old('age') == "36") {{ 'selected' }} @endif>36</option>
          <option value="37" @if (old('age') == "37") {{ 'selected' }} @endif>37</option>
          <option value="38" @if (old('age') == "38") {{ 'selected' }} @endif>38</option>
          <option value="39" @if (old('age') == "39") {{ 'selected' }} @endif>39</option>
          <option value="40" @if (old('age') == "40") {{ 'selected' }} @endif>40</option>
          <option value="41" @if (old('age') == "41") {{ 'selected' }} @endif>41</option>
          <option value="42" @if (old('age') == "42") {{ 'selected' }} @endif>42</option>
          <option value="43" @if (old('age') == "43") {{ 'selected' }} @endif>43</option>
          <option value="44" @if (old('age') == "44") {{ 'selected' }} @endif>44</option>
          <option value="45" @if (old('age') == "45") {{ 'selected' }} @endif>45</option>
          <option value="46" @if (old('age') == "46") {{ 'selected' }} @endif>46</option>
          <option value="47" @if (old('age') == "47") {{ 'selected' }} @endif>47</option>
          <option value="48" @if (old('age') == "48") {{ 'selected' }} @endif>48</option>
          <option value="49" @if (old('age') == "49") {{ 'selected' }} @endif>49</option>
          <option value="50" @if (old('age') == "46") {{ 'selected' }} @endif>50</option>
          <option value="51" @if (old('age') == "51") {{ 'selected' }} @endif>51</option>
          <option value="52" @if (old('age') == "52") {{ 'selected' }} @endif>52</option>
          <option value="53" @if (old('age') == "53") {{ 'selected' }} @endif>53</option>
          <option value="54" @if (old('age') == "54") {{ 'selected' }} @endif>54</option>
          <option value="55" @if (old('age') == "55") {{ 'selected' }} @endif>55</option>
          <option value="56" @if (old('age') == "56") {{ 'selected' }} @endif>56</option>
          <option value="57" @if (old('age') == "57") {{ 'selected' }} @endif>57</option>
          <option value="58" @if (old('age') == "58") {{ 'selected' }} @endif>58</option>
          <option value="59" @if (old('age') == "59") {{ 'selected' }} @endif>59</option>
          <option value="60" @if (old('age') == "46") {{ 'selected' }} @endif>60</option>
        </select>
        @if ($errors->has('age'))
        <span class="label label-danger">{{ $errors->first('age') }}</span>
        @endif
      </div>
      <div class="col-md-2" {{ ($errors->has('contact')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Mobile #</span></label>
        <input type="text" class="form-control" name="contact" placeholder="mobile #" value="{{old('contact')}}">
        @if ($errors->has('contact'))
        <span class="label label-danger">{{ $errors->first('contact') }}</span>
        @endif
      </div>
      <div class="col-md-3" {{ ($errors->has('email')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Email Address</span></label>
        <input type="email" class="form-control" name="email" placeholder="e.g john@gmail.com" value="{{old('email')}}"/>
        @if ($errors->has('email'))
        <span class="label label-danger">{{ $errors->first('email') }}</span>
        @endif
      </div>
      <div class="col-md-9" {{ ($errors->has('address')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Address</span></label>
        <input type="text" name="address" class="form-control" placeholder="Present Address" value="{{old('address')}}">
        @if ($errors->has('address'))
        <span class="label label-danger">{{ $errors->first('address') }}</span>
        @endif
      </div>

      <div class="container-fluid">
      </div>

      <div class="page-header" style="margin-top: 0px;">
        <h4>For New Student <span style="font-size: 10px;color:#ff0000;">(Input for New Applicant only)</span></h4>
      </div>
        
      <div class="col-md-6">
        <label><span class="label label-default">Last School Attended</span></label>
        <input type="text" style="text-transform: uppercase;" name="lstsch_attended" class="form-control" value="{{old('lstsch_attended')}}">
      </div>
      <div class="col-md-6" {{ ($errors->has('strand')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Strand</span></label>
        <select class="level form-control" name="strand" style="text-transform: uppercase;">
        <option value="">Select</option>
          @foreach ($strand as $strand)
          <option value="{{ $strand->code }}" @if (old('strand') == "{{ $strand->code }}") {{ 'selected' }} @endif>{{ $strand->strand }}</option>
          @endforeach
      </select>
      @if ($errors->has('strand'))
      <span class="label label-danger">{{ $errors->first('strand') }}</span>
      @endif
      </div>
      
      <div class="container-fluid">
      </div>
      <div class="page-header" style="margin-top: 0px;">
          <h4>For Transferee <span style="font-size: 10px;color:#ff0000;">(Input for Transferees only)</span></h4>
      </div>

      <div class="col-md-6">
        <label><span class="label label-default">College/University last attended</span></label>
        <input type="text" style="text-transform: uppercase;" name="suc_lst_attended" class="form-control" value="{{old('suc_lst_attended')}}">
      </div>

       <div class="col-md-6" {{ ($errors->has('course')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Course</span></label>
        <select class="form-control" name="course" style="text-transform: uppercase;">
          <option value="">Select Course</option>
          @foreach ($program as $programs)
          <option value="{{ $programs->code }}" @if (old('course') == "{{ $programs->code }}") {{ 'selected' }} @endif>{{ $programs->program }}</option>
          @endforeach
        </select>
        @if ($errors->has('course'))
        <span class="label label-danger">{{ $errors->first('course') }}</span>
        @endif
      </div>

      <div class="container-fluid">
      </div>
        <div class="page-header" style="margin-top: 0px;">
          <h4>Course Preferences</h4>
        </div>
          <div class="col-md-12" {{ ($errors->has('preference_1')) ? 'has-error' : ''}}>
            <label><span class="label label-default">Course Preference #1</span></label>
            <select class="form-control" name="preference_1" style="text-transform: uppercase;">
              <option value="">Select Course Preference</option>
              @foreach ($program as $programs)
              <option value="{{ $programs->code }}" @if (old('preference_1') == "{{ $programs->code }}") {{ 'selected' }} @endif>{{ $programs->program }}</option>
              @endforeach
            </select>
            @if ($errors->has('preference_1'))
            <span class="label label-danger">{{ $errors->first('preference_1') }}</span>
            @endif
          </div>
          <div class="col-md-12" {{ ($errors->has('preference_2')) ? 'has-error' : ''}}>
            <label><span class="label label-default">Course Preference #2</span></label>
            <select class="form-control" name="preference_2" style="text-transform: uppercase;">
              <option value="">Select Course Preference</option>
              @foreach ($program as $programs)
              <option value="{{ $programs->code }}" @if (old('preference_2') == "{{ $programs->code }}") {{ 'selected' }} @endif>{{ $programs->program }}</option>
              @endforeach
            </select>
            @if ($errors->has('preference_2'))
            <span class="label label-danger">{{ $errors->first('preference_2') }}</span>
            @endif
          </div>

        <div class="form-group">
            <label style="margin-top:20px;">
                <input name="remember" id="remember" type="checkbox" value="Remember Me" required> I have read and agree to the following <a data-toggle="modal" data-target="#terms"><span style="color:#04401f;">terms and conditions</span></a>
            </label>      
        </div>
  		
        <div class="text-center">
              <button type="reset" class="btn btn-danger">Application Closed</button>
   		 </div>
        </div>
  		</form>
      </div>
   </div>

    <footer class="footer">
      <div class="container">
           <p class="text-muted">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca Copyright © 2023 CPSU, All Rights Reserved.</p>
      </div>
    </footer>

    <script src="{{asset('bootstrap/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('app.js')}}"></script>
  </body>
</html>

<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
         </button>
         <h4 class="modal-title">I have read and agree to the following terms and conditions:</h4>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item"><b>Acceptance of Terms</b>: By checking this box, you agree to be bound by the terms and conditions of this agreement, as well as any policies, guidelines or amendments that may be presented to you from time to time.</li>
            <li class="list-group-item"><b>Use of Service</b>: The service is provided for work use only. You may not modify, copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer, or sell any information, software, products or services obtained from the service.</li>
            <li class="list-group-item"><b>User Conduct</b>: You agree to use the service in a lawful manner and to not engage in any activity that could harm or interfere with our service or other users. You agree to not use our service to distribute, upload, or otherwise publish any content that is defamatory, obscene, hateful, or otherwise offensive.</li>
            <li class="list-group-item"><b>Privacy</b>: Privacy policy explains how we collect, use, and protect your personal information. By using the service, you agree to the terms of the University privacy policy.</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div> 

