@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Examinee List
@endsection

@yield('style')

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
        <li>Admission</li>
        <li class="active">Examinee List</li>
    </ol>
    <div class="row">
        <p>
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success')}}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>  
            @endif
        </p>

        <form method="GET" action="{{ route('srchexamineeList') }}">
        {{ csrf_field() }}
            <div class="row"> 
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="searchclub jumbotron">
                            <div class="col-md-2">
                                <select class="form-control" id="year" name="year"></select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="campus">
                                    <option value="{{Auth::user()->campus}}">
                                        @if (Auth::user()->campus == 'MC') Main 
                                        @elseif(Auth::user()->campus == 'SCC') San Carlos 
                                        @elseif(Auth::user()->campus == 'VC') Victorias 
                                        @elseif(Auth::user()->campus == 'HC') Hinigaran 
                                        @elseif(Auth::user()->campus == 'MP') Moises Padilla 
                                        @elseif(Auth::user()->campus == 'HinC') Hinobaan 
                                        @elseif(Auth::user()->campus == 'SC') Sipalay 
                                        @elseif(Auth::user()->campus == 'IC') Ilog 
                                        @elseif(Auth::user()->campus == 'CC') Cauayan 
                                        @endif
                                    </option>

                                    @if (Auth::user()->isAdmin == 0)
                                        <option value="MC">Main</option>
                                        <option value="SCC">San Carlos</option>
                                        <option value="VC">Victorias</option>
                                        <option value="HC">Hinigaran</option>
                                        <option value="MP">Moises Padilla</option>
                                        <option value="HinC">Hinobaan</option>
                                        <option value="SC">Sipalay</option>
                                        <option value="IC">Ilog</option>
                                        <option value="CC">Cauayan</option>
                                    @else
                                    @endif
                                </select>
                            </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="admission_id" placeholder="Applicant ID">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" name="strand">
                                <option value="">Strand</option>
                                <option value="BAM">Accountancy, Business, & Management (BAM)</option>
                                <option value="GAS">General Academic Strand (GAS)</option>
                                <option value="HUMSS">Humanities, Education, Social Sciences (HUMSS)</option>
                                <option value="STEM">Science, Technology, Engineering, & Mathematics (STEM)</option>
                                <option value="TVL-CHF">TVL - Cookery, Home Economics, & FBS (TVL-CHF)</option>
                                <option value="TVL-CIV">TVL - CSS, ICT, & VGD (TVL-CIV)</option>
                                <option value="TVL-AFA">TVL - Agricultural & Fisheries Arts (TVL-AFA)</option>
                                <option value="TVL-EIM">TVL - Electrical Installation & Maintenance (TVL-EIM)</option>
                                <option value="TVL-SMAW">TVL - Shielded Metal Arc Welding (TVL-SMAW)</option>
                                <option value="OLD">Old Curriculum</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="form-control btn btn-danger">Search</button>
                        </div>
                    </div>
                    <h4>Search Results:  <small><i>Year-, Campus-, ID-,  Strand-, </i></small></h4>
                </div>
            </div>
        </div>
    </form>

    <div class="container-fluid">
        <div class="scrollme">
            <table class="table">  
                <thead>
                    <tr>
                        <th>Examinee ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Contact #</th>
                        <th>Exam Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr></tr>      
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection