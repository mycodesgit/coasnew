<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('coas-style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('dist/img/logo.png')}}" type="image/png">
    <title>@yield('title')</title>
  </head>
  <body>
 
    <nav class="navbar-default navbar-fixed-top">
      <a class="navbar-brand" href="#">CPSU - COAS V.1.0</a><span class="navbar-brand pull-right user-txt">Logged as: {{ucfirst(Auth::user()->fname)}} {{ucfirst(Auth::user()->lname)}}</span>
      <div class="navbar-header navbar-fixed-top text-center">
          <img src="{{asset('dist/img/logo.png')}}" style="width:100px;">
      </div>
    </nav>



    <div class="container-fluid" style="margin-top: 65px;">
        <div class="sidebar-menu">
            <a href="{{ route('home') }}" type="button" class="btn btn-default fas fa-school fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Homepage"><p class="sidebar-link">Home</p></a>
            <a href="{{ route('admission-index') }}" type="button" class="btn btn-default fas fa-address-card fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Admission"><p class="sidebar-link">Admission</p></a>
            <button type="button" class="btn btn-default fas fa-balance-scale fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Assessment/Billing" style="color:grey;"><p class="sidebar-link" style="color:grey;">Assessment</p></button>
            <button type="button" class="btn btn-default fas fa-calculator fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Cashiering" style="color:grey;"><p class="sidebar-link" style="color:grey;">Cashiering</p></button>
            <button type="button" class="btn btn-default fas fa-calendar-alt fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Scheduling" style="color:grey;"><p class="sidebar-link" style="color:grey;">Scheduling</p></button>
            <button type="button" class="btn btn-default fas fa-laptop-code fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Enrolment" style="color:grey;"><p class="sidebar-link" style="color:grey;">Enrolment</p></button>
            <button type="button" class="btn btn-default fas fa-users fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Scholarship" style="color:grey"><p class="sidebar-link" style="color:grey">Scholarship</p></button>
            <button type="button" class="btn btn-default fas fa-book-open fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Grading Access" style="color:grey;"><p class="sidebar-link" style="color:grey;">Grading</p></button>
            <button type="button" class="btn btn-default fas fa-file-alt fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Document Request" style="color:grey;"><p class="sidebar-link" style="color:grey;">Doc. Request</p></button>
            @if (Auth::user()->id == 1)
            <a href="{{ route('settings') }}" type="button" class="btn btn-default fas fa-cog fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Settings"><p class="sidebar-link">Settings</p></a>
            @else
            <a href="{{ route('account_edit', Auth::user()->id) }}" type="button" class="btn btn-default fas fa-cog fa-2x sidebar-icon" data-toggle="tooltip" data-placement="top" title="Settings"><p class="sidebar-link">Settings</p></a>
            @endif

            
            <a href="{{  route('logout') }}" type="button" class="btn btn-default fas fa-sign-out-alt fa-2x sidebar-icon hidden-sm hidden-xs hidden-md pull-right" data-toggle="tooltip" data-placement="top" title="Logout"><p class="sidebar-link">Logout</p></a>
            <a href="{{  route('logout') }}" class="logout-link"><button type="button" class="btn btn-default fas fa-sign-out-alt fa-2x sidebar-icon visible-xs-inline visible-sm-inline visible-md-inline" data-toggle="tooltip" data-placement="top" title="Logout"><p class="sidebar-link">Logout</p></button></a>
        </div>

        <div class="sidebar-menu col-md-2">
              <div class="page-header">
                  @section('sideheader')
                  @show
              </div>
              @section('sidemenu')
              @show

        </div>

         <div class="sidebar-menu col-md-9">
            @section('workspace') 
            @show
        </div>
      </div>
    <br><br><br><br>
    <footer class="footer">
      <div class="container">
           <p class="text-muted">CPSU - COAS V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca Copyright © 2023 CPSU, All Rights Reserved.</p>
      </div>
    </footer>
    <script src="{{asset('bootstrap/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('app.js')}}"></script>
    @section('script')
    @show
  </body>
</html>

