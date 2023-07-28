@extends('layouts.master_admission')

@section('title')
COAS - V1.0 || Slots
@endsection

<?php
use App\Models\Time;
use App\Models\Applicant;
use App\Models\Venue;
?>

@section('sideheader')
<h4>Admission</h4>
@endsection

@yield('sidemenu')

@section('workspace')
<ol class="breadcrumb">
    <li class="active"><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
    <li>Admission</li>
    <li class="active">Availability/Slots</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <p>@if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success')}}</div>
            @elseif (Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif</p>
        
        <div class="page-header" style="margin-top: 0px;">
            <h4>Availability/Slots</h4>
        </div>
        
        <div class="col-md-8">
            <div class="scrollme">
                @foreach ($date as $date)
                <h4>Admission Date: {{ $date->date }}</h4>
                <table class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($slots =  Time::where('date', $date->date)->get())
                        @foreach($slots as $slot)
                        <tr>
                            <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$slot->time)->format('h:i A')}}</td>
                            <td><span class="badge badges">{{ $avail =  Applicant::where('time','=', $slot->time)->where('d_admission','=', $slot->date)->count() }}</span> / 180</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    setTimeout(function(){
        window.location.reload();
    }, 90000);
</script>