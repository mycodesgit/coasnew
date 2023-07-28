@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Print Applicant
@endsection

@yeild('style')

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li>Print Reports</li>
        <li class="active">Print Applicant</li>
    </ol>
    <div class="row">
    <div class="container-fluid">@if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
      @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>  
    @endif</div>
    <form method="GET" action="{{ route('examination_reports') }}">
       {{ csrf_field() }}
            <div class="container-fluid">
            <div class="searchclub jumbotron">
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
              <select class="level form-control" name="strand">
                <option value="">Select</option>
                  @foreach ($strand as $strand)
                  <option value="{{ $strand->code }}" @if (old('strand') == "{{ $strand->code }}") {{ 'selected' }} @endif>{{ $strand->strand }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <input type="date" class="form-control" name="min_date">
              <small class="dateFilter">Start Date</small>
            </div>
            <div class="col-md-2">
              <input type="date" class="form-control" name="max_date">
              <small class="dateFilter">End Date</small>
            </div>
            <div class="col-md-2">
              <button type="submit" class="form-control btn btn-danger">Seach</button>
            </div>
            </div>
            <h4>Filter: {{ $totalSearchResults }} <small><i>Year-<b>{{ request('year') }}</b>, Campus-<b>{{ request('campus') }}</b>, Strand-<b>{{ request('strand') }}</b>, Start Date-<b>{{ request('min_date') }}</b>,  End Date-<b>{{ request('max_date') }}</b></i></small></h4>
          </div>
    </form>

    <div class="container-fluid">
    <table id="applicant-reports" class="display nowrap" style="width:100%">
       <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Strand</th>
                    <th>Raw Score</th>
                    <th>Percentile</th>
                    <th>Exam Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $applicant)
                @if ($applicant->p_status == 2) 
                <tr>
                  <td style="text-transform: uppercase;">{{$applicant->fname}} @if($applicant->mname == null) @else {{ substr($applicant->mname,0,1) }}.@endif {{$applicant->lname}}  @if($applicant->ext == 'N/A') @else{{$applicant->ext}}@endif</td>
                  <td>@if ($applicant->type == 1) New @elseif($applicant->type == 2) Returnee @elseif($applicant->type == 3) Transferee @endif</td>
                  <td>{{ $applicant->strand }}</td>
                  <td>{{ $applicant->result->raw_score }}</td>
                  <td>{{ $applicant->result->percentile }}</td>
                  <td>{{ $applicant->d_admission }}</td>
                </tr> 
                @else
                @endif
                @endforeach  
            </tbody>
          </table>
      </div>
    </div>
@endsection
