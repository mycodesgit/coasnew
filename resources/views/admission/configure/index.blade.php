@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Examinee List
@endsection

@section('sideheader')
<h4>Configure</h4>
@endsection

@yield('sidemenu')

@section('workspace')
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Configure Admission</li>
    </ol>
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
    @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div> 
    @endif

    <div class="tab-content">
        <div id="appPrograms" class="tab-pane fade in active">
            <div class="col-md-3 jumbotron">
                <form method="post" action="{{ URL::route('add_Program') }}">
                {{ csrf_field() }}
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Programs</h4>
                    </div>

                    <div class="col-md-12" {{ ($errors->has('code')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Program Code</span></label>
                        <input type="text" name="code" style="text-transform: uppercase;" class="form-control" value="{{old('code')}}" placeholder="Program Code">
                        @if ($errors->has('code'))
                            <span class="label label-danger">{{ $errors->first('code') }}</span>
                        @endif
                    </div>


                    <div class="col-md-12" {{ ($errors->has('program')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Program Name</span></label>
                        <input type="text" name="program" style="text-transform: uppercase;" class="form-control" value="{{old('program')}}" placeholder="Program Name">
                        @if ($errors->has('program'))
                            <span class="label label-danger">{{ $errors->first('program') }}</span>
                        @endif
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
                            @foreach ($program as $programs)
                            <tr style="text-transform: uppercase;">
                                <td>{{ $programs->code }}</td>
                                <td>{{ $programs->program }}</td>
                                <td style="text-align:center;">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Program"><i id="{{ $programs->id }}" data-toggle="modal" data-target="#info_app_program" class="btn btn-green glyphicon glyphicon-tasks info_program"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
            </div>
        </div>

        <div id="appStrand" class="tab-pane fade">
            <div class="col-md-3 jumbotron">
                <form method="post" action="{{ URL::route('add_Strand') }}">
                    {{ csrf_field() }}
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Strands</h4>
                    </div>

                    <div class="col-md-12" {{ ($errors->has('code')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Strand Code</span></label>
                        <input type="text" name="code" style="text-transform: uppercase;" class="form-control" value="{{old('code')}}" placeholder="Strand Code">
                        @if ($errors->has('code'))
                        <span class="label label-danger">{{ $errors->first('code') }}</span>
                        @endif
                    </div>

                    <div class="col-md-12" {{ ($errors->has('strand')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Strand Name</span></label>
                        <input type="text" name="strand" style="text-transform: uppercase;" class="form-control" value="{{old('strand')}}" placeholder="Strand Name">
                        @if ($errors->has('strand'))
                        <span class="label label-danger">{{ $errors->first('strand') }}</span>
                        @endif
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
                            @foreach ($strand as $strand)
                            <tr style="text-transform: uppercase;">
                                <td>{{ $strand->code}}</td>
                                <td>{{ $strand->strand }}</td>
                                <td style="text-align:center;">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Strand"><i id="{{ $strand->id }}" data-toggle="modal" data-target="#info_app_strand" class="btn btn-green glyphicon glyphicon-tasks info_strand"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
            </div>
        </div>

        <div id="appAdDate" class="tab-pane fade">
            <div class="col-md-3 jumbotron">
                <form method="post" action="{{ URL::route('add_admission_date') }}">
                    {{ csrf_field() }}
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Admission Date</h4>
                    </div>
                    <div class="col-md-12" {{ ($errors->has('date')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Admission Date</span></label>
                        <input type="date" name="date" style="text-transform: uppercase;" class="form-control" value="{{old('date')}}">
                        @if ($errors->has('date'))
                        <span class="label label-danger">{{ $errors->first('date') }}</span>
                        @endif
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
                            @foreach ($date as $date)
                            <tr style="text-transform: uppercase;">
                                <td>@if ($date->campus == 'MC') Main @elseif($date->campus == 'SCC') San Carlos @elseif($date->campus == 'VC') Victorias @elseif($date->campus == 'HC') Hinigaran @elseif($date->campus == 'MP') Moises Padilla @elseif($date->campus == 'HinC') Hinobaan @elseif($date->campus == 'SC') Sipalay @elseif($date->campus == 'IC') Ilog @elseif($date->campus == 'CC') Cauayan @endif</td>
                                <td>{{ $date->date }}</td>
                                <td style="text-align:center;">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="{{ $date->id }}" data-toggle="modal" data-target="#info_app_date" class="btn btn-green glyphicon glyphicon-tasks info_date"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
            </div>
        </div>

        <div id="appTime" class="tab-pane fade">
            <div class="col-md-3 jumbotron">
                <form method="post" action="{{ URL::route('add_admission_time') }}">
                    {{ csrf_field() }}
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Schedule Time</h4>
                    </div>
                    <div class="col-md-12" {{ ($errors->has('date')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Date</span></label>
                        <select class="form-control" name="date" style="text-transform: uppercase;">
                            <option value="">Select Date</option>
                            @foreach ($dates as $date)
                            <option value="{{ $date->date }}" @if (old('date') == "{{ $date->date }}") {{ 'selected' }} @endif>{{ $date->date }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('date'))
                        <span class="label label-danger">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                    <div class="col-md-12" {{ ($errors->has('time')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Time</span></label>
                        <input type="time" name="time" style="text-transform: uppercase;" class="form-control" value="{{old('time')}}">
                        @if ($errors->has('time'))
                        <span class="label label-danger">{{ $errors->first('time') }}</span>
                        @endif
                    </div>
                    <div class="col-md-12" {{ ($errors->has('slots')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Slots</span></label>
                        <input type="number" name="slots" style="text-transform: uppercase;" class="form-control" value="{{old('slots')}}" placeholder="Slots">
                        @if ($errors->has('slots'))
                        <span class="label label-danger">{{ $errors->first('slots') }}</span>
                        @endif
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
                            @foreach ($time as $time)
                            <tr style="text-transform: uppercase;">
                                <td>@if ($time->campus == 'MC') Main @elseif($time->campus == 'SCC') San Carlos @elseif($time->campus == 'VC') Victorias @elseif($time->campus == 'HC') Hinigaran @elseif($time->campus == 'MP') Moises Padilla @elseif($time->campus == 'HinC') Hinobaan @elseif($time->campus == 'SC') Sipalay @elseif($time->campus == 'IC') Ilog @elseif($time->campus == 'CC') Cauayan @endif</td>
                                <td>{{ $time->date }}</td>
                                <td>@if ($time->time == NULL) @else {{\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')}}@endif</td>
                                <td>{{ $time->slots }}</td>
                                <td style="text-align:center;">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="{{ $time->id }}" data-toggle="modal" data-target="#info_app_time" class="btn btn-green glyphicon glyphicon-tasks info_time"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </table>
            </div>
        </div>

        <div id="appVenue" class="tab-pane fade">
            <div class="col-md-3 jumbotron">
                <form method="post" action="{{ URL::route('add_admission_venue') }}">
                    {{ csrf_field() }}
                    <div class="page-header" style="margin-top: 0px;">
                        <h4>Venue</h4>
                    </div>
                    <div class="col-md-12" {{ ($errors->has('venue')) ? 'has-error' : ''}}>
                        <label><span class="label label-default">Venue</span></label>
                        <input type="text" name="venue" style="text-transform: uppercase;" class="form-control" value="{{old('venue')}}">
                        @if ($errors->has('venue'))
                        <span class="label label-danger">{{ $errors->first('venue') }}</span>
                        @endif
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
                            @foreach ($venue as $venue)
                            <tr style="text-transform: uppercase;">
                                <td>@if ($venue->campus == 'MC') Main @elseif($venue->campus == 'SCC') San Carlos @elseif($venue->campus == 'VC') Victorias @elseif($venue->campus == 'HC') Hinigaran @elseif($venue->campus == 'MP') Moises Padilla @elseif($venue->campus == 'HinC') Hinobaan @elseif($venue->campus == 'SC') Sipalay @elseif($venue->campus == 'IC') Ilog @elseif($venue->campus == 'CC') Cauayan @endif</td>
                                <td>{{ $venue->venue }}</td>
                                <td style="text-align:center;">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="{{ $venue->id }}" data-toggle="modal" data-target="#info_app_venue" class="btn btn-green glyphicon glyphicon-tasks info_venue"></i></a>
                                </td>
                            </tr>
                            @endforeach
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
@endsection

