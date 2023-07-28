@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Edit Data
@endsection

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')


@section('workspace')
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li>{{ $applicant->admission_id }}</li>
        <li style="text-transform: uppercase;">{{$applicant->fname}} 
            @if($applicant->mname == null) 
                @else {{ substr($applicant->mname,0,1) }}.
            @endif {{$applicant->lname}} 
             
            @if($applicant->ext == 'N/A') 
                @else{{$applicant->ext}}
            @endif</a></li>
        <li class="active">Edit Data</li>
    </ol>

    <div class="container-fluid">
        <div class="col-md-10 jumbotron">
            <div class="tab-content">
                <div id="appinfo" class="tab-pane fade in active">
                    <div class="container-fluid">
                        <div class="row">
                            <p>
                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success')}}</div>
                                @elseif (Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>  
                                @endif
                            </p>

                            <form method="POST" action="{{ route('applicant_update', $applicant->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="page-header" style="margin-top: 0px;">
                                    <h4>Applicant Information</h4>
                                </div>

                                <div class="col-md-2">
                                    <label><span class="label label-default">Admission No.</span></label>
                                    <input type="text" class="form-control" name="admissionid" value="{{$applicant->admission_id}}" disabled>
                                </div>

                                <div class="col-md-2" {{ ($errors->has('type')) ? 'has-error' : ''}}>
                                    <label><span class="label label-default">Admission Type</span></label>
                                    <select class="form-control" name="type">
                                        <option value="{{$applicant->type}}">@if ($applicant->type == 1) New @elseif($applicant->type == 2) Returnee @elseif($applicant->type == 3) Transferee @endif</option>
                                        <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>New</option>
                                        <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>Returnee</option>
                                        <option value="3" @if (old('type') == 3) {{ 'selected' }} @endif>Transferee</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="label label-danger">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-3" {{ ($errors->has('lname')) ? 'has-error' : ''}}>
                                    <label><span class="label label-default">Lastname</span></label>
                                    <input type="text" style="text-transform: uppercase;"  name="lname" class="form-control" value="{{$applicant->lname}}">
                                </div>

                                <div class="col-md-3">
                                    <label><span class="label label-default">Firstname</span></label>
                                    <input type="text" style="text-transform: uppercase;"  name="fname" class="form-control" value="{{$applicant->fname}}">
                                </div>

                                <div class="col-md-2">
                                    <label><span class="label label-default">Middlename</span></label>
                                    <input type="text" style="text-transform: uppercase;"  name="mname" class="form-control" value="{{$applicant->mname}}">
                                </div>

                                <div class="col-md-2">
                                    <label><span class="label label-default">Ext.</span></label>
                                    <select class="form-control" name="ext">
                                        <option value="{{$applicant->ext}}">
                                            @if ($applicant->ext == '') N/A 
                                                @elseif ($applicant->ext == 'Jr.') Jr. 
                                                @elseif($applicant->ext == 'Sr.') Sr. 
                                                @elseif($applicant->ext == 'III') III 
                                                @elseif($applicant->ext == 'IV') IV 
                                            @endif
                                        </option>

                                        @if ($applicant->ext == '') 
                                            @else <option value="">N/A</option>
                                        @endif

                                        @if ($applicant->ext == 'Jr.') 
                                            @else <option value="Jr.">Jr.</option>
                                        @endif

                                        @if ($applicant->ext == 'Sr.') 
                                            @else <option value="Sr.">Sr.</option>
                                        @endif

                                        @if ($applicant->ext == 'III') 
                                            @else <option value="III">III</option>
                                        @endif

                                        @if ($applicant->ext == 'IV') 
                                            @else <option value="IV">IV</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-2" {{ ($errors->has('gender')) ? 'has-error' : ''}}>
                                    <label><span class="label label-default">Gender</span></label>
                                    <select class="form-control" name="gender">
                                        <option value="{{$applicant->gender}}">{{$applicant->gender}}</option>
                                        <option value="Male" @if (old('gender') == "Male") {{ 'selected' }} @endif>Male</option>
                                        <option value="Female" @if (old('gender') == "Female") {{ 'selected' }} @endif>Female</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="label label-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <label><span class="label label-default">Date of Birth (d/m/y)</span></label>
                                    <input type="date" class="form-control" name="bday" id="bday" value="{{$applicant->bday}}">
                                </div>

                                <div class="col-md-2" {{ ($errors->has('age')) ? 'has-error' : ''}}>
                                    <label><span class="label label-default">Age</span></label>
                                    <input type="text" class="form-control" name="age" id="age" value="{{$applicant->age}}" readonly>
                                </div>

                                <div class="col-md-3">
                                    <label><span class="label label-default">Mobile #</span></label>
                                    <input type="tel" class="form-control" name="contact" value="{{$applicant->contact}}">
                                </div>

                                <div class="col-md-4">
                                    <label><span class="label label-default">Email Address</span></label>
                                    <input type="email" class="form-control" name="email" value="{{$applicant->email}}"/>
                                </div>

                                <div class="col-md-8" {{ ($errors->has('address')) ? 'has-error' : ''}}>
                                    <label><span class="label label-default">Address</span></label>
                                    <input type="text" name="address" class="form-control" value="{{$applicant->address}}" style="text-transform: uppercase;">
                                    @if ($errors->has('address'))
                                        <span class="label label-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>

                                <div class="container-fluid"></div>

                                <div class="page-header" style="margin-top: 0px;">
                                    <h4>For New Student <span style="font-size: 10px;color:#ff0000;">(Input for New Applicant only)</span></h4>
                                </div>

                                <div class="col-md-6">
                                    <label><span class="label label-default">Last School Attended</span></label>
                                    <input type="text" style="text-transform: uppercase;" name="lstsch_attended" class="form-control" value="{{$applicant->lstsch_attended}}">
                                </div>

                                <div class="col-md-6">
                                    <label><span class="label label-default">Strand</span></label>
                                    <select class="level form-control" name="strand" style="text-transform: uppercase;">
                                        <option value="{{$applicant->strand}}">
                                            @if ($applicant->strand == 'BAM') Accountancy, Business, & Management (ABM) 
                                                @elseif ($applicant->strand == 'GAS') General Academic Strand (GAS) 
                                                @elseif ($applicant->strand == 'HUMSS') Humanities, Education, Social Sciences (HUMSS) 
                                                @elseif ($applicant->strand == 'STEM') Science, Technology, Engineering, & Mathematics (STEM) 
                                                @elseif ($applicant->strand == 'TVL-CHF') TVL - Cookery, Home Economics, & FBS (TVL-CHF) 
                                                @elseif ($applicant->strand == 'TVL-CIV') TVL - CSS, ICT, & VGD (TVL-CIV) 
                                                @elseif ($applicant->strand == 'TVL-AFA') TVL - Agricultural & Fisheries Arts (TVL-AFA) 
                                                @elseif ($applicant->strand == 'TVL-EIM') TVL - Electrical Installation & Maintenance (TVL-EIM) 
                                                @elseif ($applicant->strand == 'TVL-SMAW') TVL - Shielded Metal Arc Welding (TVL-SMAW) 
                                                @elseif ($applicant->strand == 'OLD') Old Curriculum 
                                            @endif
                                        </option>
                                        @foreach ($strand as $strand)
                                        <option value="{{ $strand->code }}"
                                            @if (old('strand') == "{{ $strand->code }}") {{ 'selected' }} 
                                            @endif>{{ $strand->strand }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="container-fluid"></div>

                                <div class="page-header" style="margin-top: 0px;">
                                    <h4>For Transferee 
                                        <span style="font-size: 10px;color:#ff0000;">(Input for Transferee only)</span>
                                    </h4>
                                </div>

                                <div class="col-md-6">
                                    <label>
                                        <span class="label label-default">
                                            College/University last attended
                                        </span>
                                    </label>
                                    <input type="text" style="text-transform: uppercase;" name="suc_lst_attended" class="form-control" value="{{$applicant->suc_lst_attended}}">
                                </div>

                                <div class="col-md-6" {{ ($errors->has('course')) ? 'has-error' : ''}}>
                                    <label>
                                        <span class="label label-default">Course</span>
                                    </label>
                                    <select class="form-control" name="course" style="text-transform: uppercase;">
                                        <option value="{{$applicant->course}}">{{$applicant->course}}</option>
                                        @foreach ($program as $programs)
                                        <option value="{{ $programs->code }}" 
                                            @if (old('course') == "{{ $programs->code }}") {{ 'selected' }} 
                                            @endif>{{ $programs->program }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('course'))
                                        <span class="label label-danger">{{ $errors->first('course') }}</span>
                                    @endif
                                </div>

                                <div class="container-fluid"></div>

                                <div class="page-header" style="margin-top: 0px;">
                                    <h4>Course Preferences</h4>
                                </div>

                                <div class="col-md-12">
                                    <label>
                                        <span class="label label-default">Course Preference #1</span>
                                    </label>
                                    <select class="form-control" name="preference_1" style="text-transform: uppercase;">
                                        <option value="{{$applicant->preference_1}}">{{$applicant->preference_1}}</option>
                                        @foreach ($program as $programs)
                                            <option value="{{ $programs->code }}" 
                                                @if (old('preference_1') == "{{ $programs->code }}") {{ 'selected' }} 
                                                @endif>{{ $programs->program }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label>
                                        <span class="label label-default">Course Preference #2</span>
                                    </label>
                                    <select class="form-control" name="preference_2" style="text-transform: uppercase;">
                                        <option value="{{$applicant->preference_2}}">{{$applicant->preference_2}}</option>
                                        @foreach ($program as $programs)
                                            <option value="{{ $programs->code }}" 
                                                @if (old('preference_2') == "{{ $programs->code }}") {{ 'selected' }} 
                                                @endif>{{ $programs->program }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="container-fluid"></div>

                                <div class="page-header" style="margin-top: 0px;">
                                  <h4>Schedule of Examination</h4>
                                </div>

                                <div class="col-md-4">
                                    <label><span class="label label-default">Date of Admission Test</span></label>
                                    <select class="form-control" name="d_admission" style="text-transform: uppercase;">
                                        <option value="{{$applicant->d_admission}}">{{$applicant->d_admission}}</option>
                                        @foreach ($date as $date)
                                        <option value="{{ $date->date }}" @if (old('d_admission') == "{{ $date->date }}") {{ 'selected' }} @endif>{{ $date->date }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>
                                        <span class="label label-default">Time</span>
                                    </label>
                                    <select class="form-control" name="time" style="text-transform: uppercase;">
                                        <option value="{{ $applicant->time }}">
                                            @if ($applicant->time == NULL) @else {{\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')}}@endif
                                        </option>
                                        @foreach ($time as $time)
                                            <option value="{{ $time->time }}" 
                                                @if (old('time') == "{{ $time->time }}") {{ 'selected' }}
                                                @endif>{{\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>
                                        <span class="label label-default">Venue</span>
                                    </label>
                                    <select class="form-control" name="venue" style="text-transform: uppercase;">
                                        <option value="{{$applicant->venue}}">{{$applicant->venue}}</option>
                                        @foreach ($venue as $venue)
                                            <option value="{{ $venue->venue }}" 
                                                @if (old('venue') == "{{ $venue->venue }}") {{ 'selected' }} 
                                                @endif>{{ $venue->venue }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="container-fluid"></div>

                                <div class="page-header" style="margin-top: 0px;">
                                    <h4>Available Documents</h4>
                                </div>

                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                            <input type="radio" name="r_card" value="Yes" @foreach($docs as $doc) {{ old('r_card', $doc->r_card) === 'Yes' ? 'checked' : '' }} @endforeach> Yes
                                            <input type="radio" name="r_card" value="No" @foreach($docs as $doc) {{ old('r_card', $doc->r_card) === 'No' ? 'checked' : '' }} @endforeach> No
                                            <label>| Report Card</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" name="g_moral" value="Yes" @foreach($docs as $doc) {{ old('g_moral', $doc->g_moral) === 'Yes' ? 'checked' : '' }} @endforeach> Yes
                                            <input type="radio" name="g_moral" value="No" @foreach($docs as $doc) {{ old('g_moral', $doc->g_moral) === 'No' ? 'checked' : '' }} @endforeach> No
                                            <label>| Certificate of Good Moral</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" name="b_cert" value="Yes" @foreach($docs as $doc) {{ old('b_cert', $doc->b_cert) === 'Yes' ? 'checked' : '' }} @endforeach> Yes
                                            <input type="radio" name="b_cert" value="No" @foreach($docs as $doc) {{ old('b_cert', $doc->b_cert) === 'No' ? 'checked' : '' }} @endforeach> No
                                            <label>| Birth Certificate</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" name="m_cert" value="Yes" @foreach($docs as $doc) {{ old('m_cert', $doc->m_cert) === 'Yes' ? 'checked' : '' }} @endforeach> Yes
                                            <input type="radio" name="m_cert" value="No" @foreach($docs as $doc) {{ old('m_cert', $doc->m_cert) === 'No' ? 'checked' : '' }} @endforeach> No
                                            <label>| Medical Certificate</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" name="t_record" value="Yes" @foreach($docs as $doc) {{ old('t_record', $doc->t_record) === 'Yes' ? 'checked' : '' }} @endforeach> Yes
                                            <input type="radio" name="t_record" value="No" @foreach($docs as $doc) {{ old('t_record', $doc->t_record) === 'No' ? 'checked' : '' }} @endforeach> No
                                            <label>| Transcript of Record (For transferees)</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="radio" name="h_dismissal" value="Yes" @foreach($docs as $doc) {{ old('h_dismissal', $doc->h_dismissal) === 'Yes' ? 'checked' : '' }} @endforeach> Yes
                                            <input type="radio" name="h_dismissal" value="No" @foreach($docs as $doc) {{ old('h_dismissal', $doc->h_dismissal) === 'No' ? 'checked' : '' }} @endforeach> No
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


                <div id="schedexam" class="tab-pane fade">
                    <div class="container-fluid">
                        <div class="row">
                            <form method="POST" action="{{ route('applicant_schedule_save', $applicant->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
  
                                <div class="container-fluid"></div>

                                <div class="page-header" style="margin-top: 0px;">
                                    <h4>Schedule Examination</h4>
                                </div>

                                <div class="col-md-4">
                                    <label><span class="label label-default">Date of Admission Test</span></label>
                                    <select class="form-control" name="d_admission" style="text-transform: uppercase;">
                                        <option value="{{$applicant->d_admission}}">{{$applicant->d_admission}}</option>
                                        @foreach ($date1 as $date1)
                                            <option value="{{ $date1->date }}" 
                                                @if (old('d_admission') == "{{ $date1->date }}") {{ 'selected' }} 
                                                @endif>{{ $date1->date }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label><span class="label label-default">Time</span></label>
                                    <select class="form-control" name="time" style="text-transform: uppercase;">
                                        <option value="{{$applicant->time}}">@if ($applicant->time == NULL) @else {{\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')}}@endif</option>
                                        @foreach ($time1 as $time1)
                                            <option value="{{ $time1->time }}" 
                                                @if (old('time') == "{{ $time1->time }}") {{ 'selected' }} 
                                                @endif>{{\Carbon\Carbon::createFromFormat('H:i:s',$time1->time)->format('h:i A')}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label><span class="label label-default">Venue</span></label>
                                    <select class="form-control" name="venue" style="text-transform: uppercase;">
                                        <option value="{{$applicant->venue}}">{{$applicant->venue}}</option>
                                        @foreach ($venue1 as $venue1)
                                            <option value="{{ $venue1->venue }}" 
                                                @if (old('venue') == "{{ $venue1->venue }}") {{ 'selected' }} 
                                                @endif>{{ $venue1->venue }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="container-fluid"></div>

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
                            <div class="container-fluid">
                                <iframe src="{{ route('applicant_genPDF', $applicant->id) }}" width="100%" height="800"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="appImage" class="tab-pane fade">
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Capture Image</h4>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <form method="POST" action="{{ route('applicant_save_image', $applicant->id) }}">
                                @csrf
                                <div class="row col-md-6">
                                    <label>Camera</label>
                                    <div id="coas_camera" class="coas_camera"></div>
                                    <input type=button class="capture_snapshot btn btn-green" value="Capture Snapshot" onClick="capture_snapshot()">
                                    <input type="hidden" name="image" class="image-tag">
                                </div>
                                <div class="row col-md-6">
                                    <label>Result</label>
                                    <div id="results" class="coas_camera_result"></div>
                                    {{ csrf_field() }}
                                    <button class="capture_snapshot btn btn-green-save glyphicon glyphicon-saved"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="appPush" class="tab-pane fade">
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Push Examinee</h4>
                    </div>
                    <div class="container-fluid">
                        <div class="row text-center">
                            <p><a href="{{ route('applicant_confirm', $applicant->id) }}" type="button" class="btn btn-green-save glyphicon glyphicon-check"></a> Push to Examinee</p>
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
                <li><a data-toggle="tab" href="#schedexam" style="color:#008000;">Schedule</a></li>
                <li><a data-toggle="tab" href="#printAppForm" style="color:#008000;">View/Print</a></li>
                <li><a data-toggle="tab" href="#appImage" style="color:#008000;">Capture Image</a></li>
                <li><a data-toggle="tab" href="#appPush" style="color:#008000;">Push to Examinee</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('bootstrap/js/webcam.min.js')}}"></script>   
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

<script>
    // Function to calculate age from the date of birth
    function calculateAge() {
        const dob = document.getElementById('bday').value;
        const today = new Date();
        const birthDate = new Date(dob);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    }

    // Attach event listener to the "Date of Birth" input field
    document.getElementById('bday').addEventListener('change', calculateAge);
</script>
@endsection