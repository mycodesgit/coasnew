@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Add Applicant
@endsection

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
    <ol class="breadcrumb">
        <li class="active"><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li class="active">Add Applicant</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <p>
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success')}}</div>
                @elseif (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>  
                @endif
            </p>

            <form method="post" action="{{ route('post-applicant-add') }}" enctype="multipart/form-data">
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
                    <input type="date" class="form-control" name="bday" id="bday" value="{{old('bday')}}">
                </div>

                <div class="col-md-2" {{ ($errors->has('age')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Age</span></label>
                    <input type="text" class="form-control" name="age" id="age" readonly>
                </div>

                <div class="col-md-2" {{ ($errors->has('contact')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Mobile #</span></label>
                    <input type="text" class="form-control" name="contact" placeholder="mobile #" value="{{old('contact')}}">
                    @if ($errors->has('contact'))
                        <span class="label label-danger">{{ $errors->first('contact') }}</span>
                    @endif
                </div>

                <div class="col-md-2" {{ ($errors->has('email')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Email Address</span></label>
                    <input type="email" class="form-control" name="email" placeholder="e.g john@gmail.com" value="{{old('email')}}"/>
                    @if ($errors->has('email'))
                    <span class="label label-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="col-md-12" {{ ($errors->has('address')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Address</span></label>
                    <input type="text" name="address" class="form-control" placeholder="Present Address" value="{{old('address')}}" style="text-transform: uppercase;">
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
                    <input type="text" style="text-transform: uppercase;" name="lstsch_attended" class="form-control" value="{{old('lstsch_attended')}}">
                </div>

                <div class="col-md-6" {{ ($errors->has('strand')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Strand</span></label>
                    <select class="level form-control" name="strand" style="text-transform: uppercase;">
                        <option value="">Select</option>
                        @foreach ($strand as $strand)
                            <option value="{{ $strand->code }}" @if (old('strand') == "{{ $strand->code }}") {{ 'selected' }} @endif>{{ $strand->strand }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('strand'))
                        <span class="label label-danger">{{ $errors->first('strand') }}</span>
                    @endif
                </div>
      
                <div class="container-fluid"></div>
                
                <div class="page-header" style="margin-top: 0px;">
                    <h4>For Transferee <span style="font-size: 10px;color:#ff0000;">(Input for Transferee only)</span></h4>
                </div>

                <div class="col-md-6">
                    <label><span class="label label-default">College/University last attended<span></label>
                    <input type="text" style="text-transform: uppercase;" name="suc_lst_attended" class="form-control" value="{{old('suc_lst_attended')}}">
                </div>

                <div class="col-md-6" {{ ($errors->has('course')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Course</span></label>
                    <select class="form-control" name="course" style="text-transform: uppercase;">
                        <option value="">Select Course</option>
                        @foreach ($program as $programs)
                        <option value="{{ $programs->code }}" @if (old('course') == "{{ $programs->code }}") {{ 'selected' }} @endif>{{ $programs->program }}
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

                <div class="col-md-12" {{ ($errors->has('preference_1')) ? 'has-error' : ''}}>
                    <label><span class="label label-default">Course Preference #1</span></label>
                    <select class="form-control" name="preference_1" style="text-transform: uppercase;">
                        <option value="">Select Course Preference</option>
                        @foreach ($program as $programs)
                        <option value="{{ $programs->code }}" @if (old('course') == "{{ $programs->code }}") {{ 'selected' }} @endif>{{ $programs->program }}
                        </option>
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
                        <option value="{{ $programs->code }}" @if (old('course') == "{{ $programs->code }}") {{ 'selected' }} @endif>{{ $programs->program }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('preference_2'))
                        <span class="label label-danger">{{ $errors->first('preference_2') }}</span>
                    @endif
                </div>
     
                <div class="container-fluid"></div>

                <div class="page-header" style="margin-top: 0px;">
                    <h4>Schedule of Examination</h4>
                </div>

                <div class="col-md-4">
                    <label><span class="label label-default">Date of Admission Test</span></label>
                    <select class="form-control" name="d_admission" style="text-transform: uppercase;">
                        <option value="">Select Date</option>
                        @foreach ($date as $date)
                        <option value="{{ $date->date }}" @if (old('d_admission') == "{{ $date->date }}") {{ 'selected' }} @endif>{{ $date->date }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label><span class="label label-default">Time</span></label>
                    <select class="form-control" name="time">
                        <option value="">N/A</option>
                        @foreach ($time as $time)
                        <option value="{{ $time->time }}" @if (old('time') == "{{ $time->time }}") {{ 'selected' }} @endif>{{\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')}}</option>
                        @endforeach
                    </select>
                </div>
      
                <div class="col-md-4">
                    <label><span class="label label-default">Venue</span></label>
                    <select class="form-control" name="venue" style="text-transform: uppercase;">
                        <option value="">Select Venue</option>
                        @foreach ($venue as $venue)
                        <option value="{{ $venue->venue }}" @if (old('venue') == "{{ $venue->venue }}") {{ 'selected' }} @endif>{{ $venue->venue }}</option>
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
@endsection

@section('script')
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
