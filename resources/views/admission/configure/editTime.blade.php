@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Configure Admission
@endsection

@yeild('style')

@section('sideheader')

<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
<ol class="breadcrumb">
  <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
  <li>Configure Admission</li>
  <li>Edit <b>{{ $time->time }}</b> Data</li>
</ol>
@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
  @elseif (Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div> 
@endif

  <div class="col-md-3 jumbotron">
    <form method="post" action="{{ URL::route('timeEdit', $time->id) }}">
        {{ csrf_field() }}
        <div class="page-header" style="margin-top: 0px;">
          <h4>Schedule Time</h4>
       </div>

       <div class="col-md-12" {{ ($errors->has('date')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Date</span></label>
        <select class="form-control" name="date" style="text-transform: uppercase;">
          <option value="{{ $time->date }}">{{ $time->date }}</option>
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
        <input type="time" name="time" style="text-transform: uppercase;" class="form-control" value="{{ $time->time }}">
        @if ($errors->has('time'))
        <span class="label label-danger">{{ $errors->first('time') }}</span>
        @endif
      </div>

      <div class="col-md-12" {{ ($errors->has('slots')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Slots</span></label>
        <input type="number" name="slots" style="text-transform: uppercase;" class="form-control" value="{{ $time->slots }}">
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
          @foreach ($times as $time)
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

@endsection
 
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