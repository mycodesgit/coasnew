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
        .tableFixHead {
            overflow-y: auto;height: 700px;
        }
        .tableFixHead thead th {
            position: relative;top: 0px;
        }
        th,td {
            padding: 8px 16px;border: 1px solid #ccc;
        }
        th {
            background: #eee;
        }
        .dataTables_filter {
            float: center !important;margin-top: -50px;
        }
        .dateFilter{
            position:absolute;font-size: 10px;color:#d9534f;
        }
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
                    <li class="active">Track Admission</li>
                </ol>
                <p>@if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success')}}</div>
                    @elseif (Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif</p>
                <div class="row">
                    <form method="GET" action="">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="searchclub jumbotron">
                                        <div class="row col-md-4">
                                            <input type="text" class="form-control" name="admission_id" placeholder="Applicant ID" >
                                        </div>
                                        <div class="row col-md-2">
                                            <button type="" class="form-control btn btn-green">Search (Closed)</button>
                                            <button type="" class="form-control btn btn-green hidden-lg hidden-md" style="margin-top: 10px;">Search (Closed)</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm" style="border:2px solid #04401f;">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="{{asset('dist/img/logo.png')}}" style="margin:auto;padding: 30px 0;" alt="" class="img-rounded img-responsive"/>
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    @foreach ($data as $applicant)
                                        <h4>Admission ID: {{ $applicant->admission_id }}<span id="p1"></span></h4>
                                        <h5>Name: {{ $applicant->fname }} {{ substr($applicant->mname,0,1) }}. {{ $applicant->lname }}</h5>
                                        <h5>Preferred Campus: @if ($applicant->campus == 'MC') Main @elseif($applicant->campus == 'SCC') San Carlos @elseif($applicant->campus == 'VC') Victorias @elseif($applicant->campus == 'HC') Hinigaran @elseif($applicant->campus == 'MP') Moises Padilla @elseif($applicant->campus == 'HinC') Hinobaan @elseif($applicant->campus == 'SC') Sipalay @elseif($applicant->campus == 'IC') Ilog @elseif($applicant->campus == 'CC') Cauayan @endif</h5>
                                        <h5>Date of Birth: {{ $applicant->bday }}</h5>
                                        <h5>Email Address: {{ $applicant->email }}</h5>
                                        <h5>Contact: {{ $applicant->contact }}</h5>
                                        <h5>Present Address:{{ $applicant->address }}</h5>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm" style="border:2px solid #04401f;">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge success">
                                        <span class="glyphicon glyphicon-check"></span>
                                    </div>
                                    <div class="timeline-date">
                                        <h5 style="font-size: 10px;">{{  $applicant->created_at->format('M d, Y') }}</h5>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <div class="timeline-title">
                                                <p>Application</p>
                                                <h5>Submitted/Recorded Applicant Information</h5>
                                                <h6 class="text-success">Status: Applied for Admission</h6>
                                                <h6><i>Date: {{ $applicant->created_at->format('m-d-Y') }}</i></h6>
                                            </div>
                                        </div>
                                        <div class="timeline-body">
                                            <div class="row">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    @if ($applicant->p_status == 2 || $applicant->p_status == 3 || $applicant->p_status == 4 || $applicant->p_status == 5)
                                        <div class="timeline-badge success">
                                            <span class="glyphicon glyphicon-check"></span>
                                        </div>
                                        
                                        <div class="timeline-date">
                                            <h5 style="font-size: 10px;">{{  $applicant->result->created_at->format('M d, Y') }}</h5>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <div class="timeline-title">
                                                    <p>Examination Schedule</p>
                                                    <h5>Exam Schedule set! <b>Date</b>: {{ $applicant->d_admission }}, <b>Time</b>: {{ Carbon\Carbon::parse($applicant->time)->format('h:i A') }}, <b>Venue</b>: {{ $applicant->venue }}</h5>
                                                    @if ($applicant->p_status == 2 || $applicant->p_status == 3 || $applicant->p_status == 4 || $applicant->p_status == 5)
                                                    <h6><i>Status: Scheduled</i></h6>
                                                    @else
                                                    <h6><i>Status: Waiting</i></h6>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="row">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="timeline-badge warning">
                                            <span class="glyphicon glyphicon-hourglass"></span>
                                        </div>
                                        
                                        <div class="timeline-date">
                                            <h5 style="font-size: 10px;">Waiting</h5>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <div class="timeline-title">
                                                    <p>Examination Schedule</p>
                                                    <h5>Exam Schedule set! <b>Date</b>: , <b>Time</b>: , <b>Venue</b>: </h5>
                                                    <h6><i>Status: Waiting</i></h6>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="row">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                                <li>
                                    @if ($applicant->p_status == 3 || $applicant->p_status == 4 || $applicant->p_status == 5)
                                        <div class="timeline-badge success">
                                            <span class="glyphicon glyphicon-check"></span>
                                        </div>
                                        <div class="timeline-date">
                                            <h5 style="font-size: 10px;">{{  $applicant->result->created_at->format('M d, Y') }}</h5>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <div class="timeline-title">
                                                    <p>Examination Results</p>
                                                    <h5>Result is out!</h5>
                                                    <!--<h6 style="text-indent: 50px;"><i><b>Raw Score</b>: {{  $applicant->result->raw_score }}</i></h6>-->

                                                    <h6 style="text-indent: 50px;">
                                                        <i>
                                                            <b>Percentile</b>: {{  $applicant->result->percentile }}
                                                        </i>
                                                    </h6>
                                                    <h6 style="text-indent: 50px;">
                                                        <i>
                                                            <b>Remark</b>: 
                                                            @if ($applicant->result->percentile <= 25)  FAILED 
                                                                @else PASSED 
                                                            @endif
                                                        </i>
                                                    </h6>
                                                    <h5 style="text-indent: 50px;">
                                                        <b>
                                                            @if ($applicant->result->percentile <= 25)  NOT QUALIFIED TO ENROLL 
                                                                @else QUALIFIED TO ENROLL 
                                                            @endif
                                                        </b>
                                                    </h5>
                                                    <h6 style="text-indent: 50px;">
                                                        <i>
                                                            @if ($applicant->result->percentile <= 25)  
                                                                @else * Subject to College Screening Process 
                                                            @endif
                                                        </i>
                                                    </h6>
                                                    <h6><i>Status: {{ $applicant->result->created_at->format('m-d-Y h:i A') }}</i></h6>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="row">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="timeline-badge warning">
                                            <span class="glyphicon glyphicon-hourglass"></span>
                                        </div>
                                        <div class="timeline-date">
                                            <h5 style="font-size: 10px;">Waiting</h5>
                                        </div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <div class="timeline-title">
                                                    <p>Examination Results</p>
                                                    <h5>Results is out! Your <b>score</b>: , <b>Percentile</b>: </h5>
                                                    <h6><i>Status: Waiting</i></h6>
                                                </div>
                                            </div>
                                            <div class="timeline-body">
                                                <div class="row">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                                <li>
                                    @if ($applicant->result->percentile > 25) {{-- Added condition to check if the remarks indicate "Passed" --}}
                                        @if ($applicant->p_status == 4 || $applicant->p_status == 5)
                                            <div class="timeline-badge success">
                                                <span class="glyphicon glyphicon-check"></span>
                                            </div>
                                            <div class="timeline-date">
                                                <h5 style="font-size: 10px;">{{  $applicant->updated_at->format('M d, Y') }}</h5>
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <div class="timeline-title">
                                                        <p>Confirmation</p>
                                                        <h5>Confirmed pre-enrollment!</h5>
                                                        <h6><i>Status: Confirmed</i></h6>
                                                    </div>
                                                </div>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="timeline-badge warning">
                                                <span class="glyphicon glyphicon-hourglass"></span>
                                            </div>
                                            <div class="timeline-date">
                                                <h5 style="font-size: 10px;">Waiting</h5>
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <div class="timeline-title">
                                                        <p>Confirmation</p>
                                                        <h5>Waiting for confirmation on Pre-enrollment!</h5>
                                                        <h6><i>Status: Waiting</i></h6>
                                                    </div>
                                                </div>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </li>
                                <li>
                                    @if ($applicant->result->percentile > 25) {{-- Added condition to check if the remarks indicate "Passed" --}}
                                        @if ($applicant->p_status == 5)
                                            <div class="timeline-badge success">
                                                <span class="glyphicon glyphicon-check"></span>
                                            </div>
                                            <div class="timeline-date">
                                                <h5 style="font-size: 10px;">{{ $applicant->interview->created_at->format('M d, Y')}}</h5>
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <div class="timeline-title">
                                                        <p>Acceptance</p>
                                                        <h5>Accepted for the program <b>{{ $applicant->interview->course}}</b></h5>
                                                        <h6><i>Status: Accepted</i></h6>
                                                    </div>
                                                </div>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="timeline-badge warning">
                                                <span class="glyphicon glyphicon-hourglass"></span>
                                            </div>
                                            <div class="timeline-date">
                                                <h5 style="font-size: 10px;">Waiting</h5>
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <div class="timeline-title">
                                                        <p>Acceptance</p>
                                                        <h5>Accepted for the program <b></b></h5>
                                                        <h6><i>Status: Waiting</i></h6>
                                                    </div>
                                                </div>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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