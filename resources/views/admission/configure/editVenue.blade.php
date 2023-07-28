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
  <li>Edit <b>{{ $venue->venue }}</b> Data</li>
</ol>
@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
  @elseif (Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div> 
@endif

  <div class="col-md-3 jumbotron">
    <form method="post" action="{{ URL::route('venueEdit', $venue->id) }}">
        {{ csrf_field() }}
        <div class="page-header" style="margin-top: 0px;">
          <h4>Admission Date</h4>
       </div>

      <div class="col-md-12" {{ ($errors->has('venue')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Strand Name</span></label>
        <input type="text" name="venue" style="text-transform: uppercase;" class="form-control" value="{{ $venue->venue }}">
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
          @foreach ($venues as $venue)
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

@endsection
 
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