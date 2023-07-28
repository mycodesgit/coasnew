@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Schedule Examination
@endsection

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
<ol class="breadcrumb">
    <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
    <li>Schedule Examination</li>
    <li>{{ $applicant->admission_id }}</li>
    <li style="text-transform: uppercase;">{{$applicant->fname}} @if($applicant->mname == null) @else {{ substr($applicant->mname,0,1) }}.@endif {{$applicant->lname}}  @if($applicant->ext == 'N/A') @else{{$applicant->ext}}@endif</li>
    <li class="active">Schedule</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <p>@if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success')}}</div>
            @elseif (Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif</p>
        <form method="POST" action="{{ route('applicant_schedule_save', $applicant->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="container-fluid">
            </div>
            <div class="page-header" style="margin-top: 0px;">
                <h4>Schedule Examination</h4>
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
                <label><span class="label label-default">Time</span></label>
                <select class="form-control" name="time" style="text-transform: uppercase;">
                    <option value="{{ $applicant->time }}">@if ($applicant->time == NULL) @else {{\Carbon\Carbon::createFromFormat('H:i:s',$applicant->time)->format('h:i A')}}@endif</option>
                    @foreach ($time as $time)
                    <option value="{{ $time->time }}" @if (old('time') == "{{ $time->time }}") {{ 'selected' }} @endif>{{\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label><span class="label label-default">Venue</span></label>
                <select class="form-control" name="venue" style="text-transform: uppercase;">
                    <option value="{{$applicant->venue}}">{{$applicant->venue}}</option>
                    @foreach ($venue as $venue)
                    <option value="{{ $venue->venue }}" @if (old('venue') == "{{ $venue->venue }}") {{ 'selected' }} @endif>{{ $venue->venue }}</option>
                    @endforeach
                </select>
            </div>
            <div class="container-fluid">
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
@endsection