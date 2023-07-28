@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Generate Admission Schedules
@endsection

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li>Print Reports</li>
        <li class="active">Generate Admission Schedules</li>
    </ol>
    <div class="row">
    <p>@if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
      @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>  
    @endif</p>

    
        <div class="row"> 
          <div class="col-md-12">
            <div class="container-fluid">
            <form method="GET" action="{{ route('schedules_reports') }}">
            {{ csrf_field() }}
            <div class="jumbotron" style="padding-top:20px;padding-bottom:100px; margin:20px;">
            <div class="col-md-12">
            <div class="col-md-2">
              <select class="form-control" id="year" name="year">
              </select>
            </div>
            <div class="col-md-2">
                <select class="form-control" name="campus">
                 <option value="{{Auth::user()->campus}}">@if (Auth::user()->campus == 'MC') Main @elseif(Auth::user()->campus == 'SCC') San Carlos @elseif(Auth::user()->campus == 'VC') Victorias @elseif(Auth::user()->campus == 'HC') Hinigaran @elseif(Auth::user()->campus == 'MP') Moises Padilla @elseif(Auth::user()->campus == 'HinC') Hinobaan @elseif(Auth::user()->campus == 'SC') Sipalay @elseif(Auth::user()->campus == 'IC') Ilog @elseif(Auth::user()->campus == 'CC') Cauayan @endif</option>
                @if (Auth::user()->isAdmin == 0)
                @else
                @endif
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" name="date">
                <option value="">Date</option>
                <option value="">All</option>
                @foreach ($date as $date)
                <option value="{{ $date->date }}" @if (old('date') == "{{ $date->date }}") {{ 'selected' }} @endif>{{ $date->date }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <select class="form-control" name="time">
                <option value="">Time</option>
                <option value="">All</option>
                @foreach ($time as $time)
                <option value="{{ $time->time }}" @if (old('time') == "{{ $time->time }}") {{ 'selected' }} @endif>{{\Carbon\Carbon::createFromFormat('H:i:s',$time->time)->format('h:i A')}}</option>
                @endforeach  
              </select>
            </div>
            <div class="col-md-4">
              <select class="form-control" name="venue">
                <option value="">Venue</option>
                <option value="">All</option>
                @foreach ($venue as $venue)
                <option value="{{ $venue->venue }}" @if (old('venue') == "{{ $venue->venue }}") {{ 'selected' }} @endif>{{ $venue->venue }}</option>
                @endforeach
              </select>
            </div>
           </div>

           <div class="col-md-12" style="margin-top: 10px;">
            <div class="col-md-4">
              <select class="level form-control" name="strand">
                <option value="">Select</option>
                  @foreach ($strand as $strand)
                  <option value="{{ $strand->code }}" @if (old('strand') == "{{ $strand->code }}") {{ 'selected' }} @endif>{{ $strand->strand }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <input type="date" class="form-control" name="min_date">
              <small class="dateFilter">Start Date</small>
            </div>
            <div class="col-md-3">
              <input type="date" class="form-control" name="max_date">
              <small class="dateFilter">End Date</small>
            </div>
            <div class="col-md-2">
              <button type="submit" class="form-control btn btn-danger">Seach</button>
            </div>
            </div>
            </form>
            </div>
          </div>
          </div>
        </div>
    

    <div class="container-fluid"><h4>Filter:  <small><i>Year-, Campus-, ID-,Date-, Time-, Venue-, Strand-, Start Date-, End Date-</i></small></h4>

      <div class="scrollme">
        <table class="table">  
          <thead>
                <tr>
                    <th>Name</th>
                    <th>Strand</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Venue</th>
                </tr>
            </thead>
             <tbody>
                <tr>
                </tr>      
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection