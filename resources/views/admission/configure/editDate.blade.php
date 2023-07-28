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
  <li>Edit <b>{{ $date->date }}</b> Data</li>
</ol>
@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
  @elseif (Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div> 
@endif

  <div class="col-md-3 jumbotron">
    <form method="post" action="{{ URL::route('dateEdit', $date->id) }}">
        {{ csrf_field() }}
        <div class="page-header" style="margin-top: 0px;">
          <h4>Admission Date</h4>
       </div>

      <div class="col-md-12" {{ ($errors->has('date')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Strand Name</span></label>
        <input type="date" name="date" style="text-transform: uppercase;" class="form-control" value="{{ $date->date }}">
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
          @foreach ($dates as $date)
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

@endsection
 
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