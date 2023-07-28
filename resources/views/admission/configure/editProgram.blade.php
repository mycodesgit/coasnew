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
  <li>Edit <b>{{ $program->program }}</b> Data</li>
</ol>
@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
  @elseif (Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div> 
@endif

 <div class="col-md-3 jumbotron">
    <form method="post" action="{{ route('programEdit', $program->id) }}">
        {{ csrf_field() }}
        <div class="page-header" style="margin-top: 0px;">
          <h4>Manage Programs</h4>
       </div>

        <div class="col-md-12" {{ ($errors->has('code')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Program Code</span></label>
        <input type="text" name="code" style="text-transform: uppercase;" class="form-control" value="{{ $program->code }}">
        @if ($errors->has('code'))
        <span class="label label-danger">{{ $errors->first('code') }}</span>
        @endif
      </div>


      <div class="col-md-12" {{ ($errors->has('program')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Program Name</span></label>
        <input type="text" name="program" style="text-transform: uppercase;" class="form-control" value="{{ $program->program }}">
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
          @foreach ($programs as $programs)
          <tr style="text-transform: uppercase;">
              <td>{{ $programs->code }}</td>
              <td>{{ $programs->program }}</td>
              <td style="text-align:center;">
              <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="{{ $programs->id }}" data-toggle="modal" data-target="#info_app_program" class="btn btn-green glyphicon glyphicon-tasks info_program"></i></a>
            </td>
          </tr>  
          @endforeach  
         </table>  
       </div>
      </table>
    </div>
  </div>
@endsection

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
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_program"></a>   Edit Program Data</p>
              <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_program"></a> Remove Program</p>
            </div>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End Program -->