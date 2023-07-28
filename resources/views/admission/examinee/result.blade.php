@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Examinee Result
@endsection

@yield('style')

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')


@section('workspace')
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Examinee Result</li>
        <li>{{ $assignresult->admission_id }}</li>
        <li style="text-transform: uppercase;">{{$assignresult->fname}} @if($assignresult->mname == null) @else {{ substr($assignresult->mname,0,1) }}.@endif {{$assignresult->lname}}  @if($assignresult->ext == 'N/A') @else{{$assignresult->ext}}@endif</li>
        <li class="active">Assign</li>
    </ol>
    <div class="container-fluid">
    <div class="row">
    <p>@if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
      @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>  
    @endif</p>

      <div id="updateTestResult" class="tab-pane fade in active">
        <div class="container-fluid">
          <div class="page-header" style="margin-top: 0px;">
            <h4>Update Test Result</h4>
          </div>
        <form method="POST" action="{{ route('examinee_result_save_nd', $assignresult->id) }}">
            @csrf
            @method('PUT')
           <div class="col-md-offset-2 col-md-4">
            <label><span class="label label-default">Raw Score</span></label>
            <input type="text" class="form-control" name="raw_score" value="{{$assignresult->result->raw_score}}">
          </div>
          <div class="col-md-4">
            <label><span class="label label-default">Precentile</span></label>
            <input type="text" class="form-control" name="percentile" value="{{$assignresult->result->percentile}}">
          </div>
          <div class="container-fluid">
          </div>
          <div class="modal-footer text-center" style="border:0px">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-green-save glyphicon glyphicon-saved"></button>
                <button type="reset" class="btn btn-danger glyphicon glyphicon-repeat"></button>
              </div>
          </div>
        </form>
        </div>
      </div>

  </div>
</div>
</div>
@endsection