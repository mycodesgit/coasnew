<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('coas-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist/dataTables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist/dataTables/css/buttons.dataTables.min.css')}}">

    <!-- DataTable -->
    {{-- link rel="stylesheet" href="{{ asset('dist/Data-Tables/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/Data-Tables/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/Data-Tables/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{URL::asset('dist/img/logo.png')}}">
    <title>@yield('title')</title>
</head>

@section('style')
    <style type="text/css">
        .tableFixHead {
            overflow-y: auto;height: 700px;
        }
        .tableFixHead thead th {
            position: relative;top: 0px;
        }
        th,td {
            padding: 8px 16px;border: 1px solid #ccc;
        }
        th {
            background: #eee;
        }
        .dataTables_filter {
            float: center !important;margin-top: -50px;
        }
        .dateFilter{
            position:absolute;font-size: 10px;color:#d9534f;
        }
    </style>
@show

<body>
    <nav class="navbar-default navbar-fixed-top">
        <a class="navbar-brand" href="#">CPSU - COAS V.1.0</a><span class="navbar-brand pull-right user-txt">Logged as: {{ucfirst(Auth::user()->fname)}} {{ucfirst(Auth::user()->lname)}}</span>
        <div class="navbar-header navbar-fixed-top text-center">
            <img src="{{asset('dist/img/logo.png')}}" style="width:100px;">
        </div>
    </nav>

    <div class="container-fluid" style="margin-top: 65px;">
        <div class="sidebar-menu col-md-2">
            <div class="page-header">
                @section('sideheader')
                @show
            </div>
            @section('sidemenu')

            @php
                $current_sidebar_route=request()->route()->getName();
            @endphp

            @if (Auth::user()->isAdmin == 0)
                <ul class="list-group">
                    <a href="{{ route('applicant-add') }}" class="list-group-item {{ $current_sidebar_route=='applicant-add'?'active':''}}">Add Applicants
                    </a>

                    <a href="{{ route('applicant-list') }}" class="list-group-item {{ $current_sidebar_route=='applicant-list'?'active':''}}">Applicants
                    </a>

                    <a href="{{ route('examinee-list') }}" class="list-group-item {{ $current_sidebar_route=='examinee-list'?'active':''}}">List of Examinees
                    </a>

                    <a href="{{ route('result-list') }}" class="list-group-item {{ $current_sidebar_route=='result-list'?'active':''}}">Examination Results
                    </a>

                    <a href="{{ route('examinee-confirm') }}" class="list-group-item {{ $current_sidebar_route=='examinee-confirm'?'active':''}}">Confirmed Applicants
                    </a>  

                    <a href="{{ route('applicant-accepted') }}" class="list-group-item {{ $current_sidebar_route=='applicant-accepted'?'active':''}}">Accepted Applicants
                    </a>

                    <a href="{{ route('slots') }}" class="list-group-item {{ $current_sidebar_route=='slots'?'active':''}}">Availability/Slots
                    </a>

                    <a href="{{ route('configure_admission') }}" class="list-group-item {{ $current_sidebar_route=='configure_admission'?'active':''}}">Configure Admission
                    </a>
                </ul>
                <div class="page-header">
                    Reporting
                </div>
                <ul class="list-group">
                    <a href="{{ route('applicant_printing') }}" class="list-group-item {{ $current_sidebar_route=='applicant_printing'?'active':''}}">Applicants</a>
                    <a href="{{ route('schedules_printing') }}" class="list-group-item {{ $current_sidebar_route=='schedules_printing'?'active':''}}">Admission Schedules</a>
                    <a href="{{ route('examination_printing') }}" class="list-group-item {{ $current_sidebar_route=='examination_printing'?'active':''}}">Examination Results</a>
                    <a href="{{ route('qualified_printing') }}" class="list-group-item {{ $current_sidebar_route=='qualified_printing'?'active':''}}">List of Qualified Applicants</a>
                    <a href="{{ route('confirm_printing') }}" class="list-group-item {{ $current_sidebar_route=='confirm_printing'?'active':''}}">Confirmed Applicants</a> 
                    <a href="{{ route('accepted_printing') }}" class="list-group-item {{ $current_sidebar_route=='accepted_printing'?'active':''}}">List of Accepted Applicants</a>
                </ul>

            @elseif (Auth::user()->isAdmin == 1 || Auth::user()->isAdmin == 2)
                <ul class="list-group">
                    <a href="{{ route('applicant-add') }}" class="list-group-item {{ $current_sidebar_route=='applicant-add'?'active':''}}">Add Applicants</a>
                    <a href="{{ route('applicant-list') }}" class="list-group-item {{ $current_sidebar_route=='applicant-list'?'active':''}}">Applicants</a>  
                    <a href="{{ route('examinee-list') }}" class="list-group-item {{ $current_sidebar_route=='examinee-list'?'active':''}}">List of Examinees</a>
                    <a href="{{ route('result-list') }}" class="list-group-item {{ $current_sidebar_route=='result-list'?'active':''}}">Examination Results</a>
                    <a href="{{ route('slots') }}" class="list-group-item {{ $current_sidebar_route=='slots'?'active':''}}">Availability/Slots</a>
                    <a href="{{ route('configure_admission') }}" class="list-group-item {{ $current_sidebar_route=='configure_admission'?'active':''}}">Configure Admission</a>
                </ul>
                <div class="page-header">
                    Reporting
                </div>
                <ul class="list-group">
                    <a href="{{ route('applicant_printing') }}" class="list-group-item {{ $current_sidebar_route=='applicant_printing'?'active':''}}">Applicants</a>
                    <a href="{{ route('examination_printing') }}" class="list-group-item {{ $current_sidebar_route=='examination_printing'?'active':''}}">Examination Results</a>
                    <a href="{{ route('qualified_printing') }}" class="list-group-item {{ $current_sidebar_route=='qualified_printing'?'active':''}}">List of Qualified Applicants</a>
                    <a href="{{ route('confirm_printing') }}" class="list-group-item {{ $current_sidebar_route=='confirm_printing'?'active':''}}">Confirmed Applicants</a> 
                    <a href="{{ route('accepted_printing') }}" class="list-group-item {{ $current_sidebar_route=='accepted_printing'?'active':''}}">List of Accepted Applicants</a>
                </ul>
            @elseif (Auth::user()->isAdmin == 5 || Auth::user()->isAdmin == 6 || Auth::user()->isAdmin == 7)
                <ul class="list-group">
                    <a href="{{ route('result-list') }}" class="list-group-item {{ $current_sidebar_route=='result-list'?'active':''}}">Examination Results</a>
                    <a href="{{ route('examinee-confirm') }}" class="list-group-item {{ $current_sidebar_route=='examinee-confirm'?'active':''}}">Confirmed Applicants</a>  
                    <a href="{{ route('applicant-accepted') }}" class="list-group-item {{ $current_sidebar_route=='applicant-accepted'?'active':''}}">Accepted Applicants</a>
                </ul>
            @endif
                <div class="page-header">
                  CPSU - COAS V.1.0
                </div>
            @show
        </div>

         <div class="sidebar-menu col-md-9">
            @section('workspace')
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
                <li>Admission</li>
            </ol>
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success')}}</div>
            @elseif (Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div> 
            @endif
            <div class="workspace-top" style="text-align: center;">
                <h1 class="fas fa-mug-hot fa-7x"></h1>
                <h1>
                    <span style="color:#ffff66;font-size: 70px;">Eey!</span> Grab a coffee before doing something
                </h1>
                <p>
                    <i class="fas fa-quote-left fa-2x fa-pull-left"></i>
                    Gatsby believed in the green light, the orgastic future that year by year recedes before us.
                    It eluded us then, but that’s no matter — tomorrow we will run faster, stretch our arms further...
                    And one fine morning — So we beat on, boats against the current, borne back ceaselessly into the past.
                </p>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            </div> 
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
    <script src="{{asset('dist/dataTables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dist/dataTables/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dist/dataTables/js/jszip.min.js')}}"></script>
    <script src="{{asset('dist/dataTables/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('dist/dataTables/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('dist/dataTables/js/vfs_fonts.js')}}"></script>
    <script src="{{asset('dist/dataTables/js/buttons.html5.min.js')}}"></script>

    <!-- DataTables  & Plugins -->
    {{-- <script src="{{ asset('dist/Data-Tables/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dist/Data-Tables/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
    @section('script')

    <script>
    $(function () {
        $("#applicant-list1").DataTable({
            "responsive": true,
            "lengthChange": false, 
            "autoWidth": true,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#applicant-list1_wrapper .col-md-6:eq(0)');

        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

        $("#example4").DataTable({
            "responsive": false,
            "lengthChange": false, 
            "autoWidth": false,
            "searching": false
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    
    <script type="text/javascript">

    (() => {
        let year_satart = (new Date).getFullYear();
        let year_end = 2030;
        let year_selected = (new Date).getFullYear();
        let option = '';
        option = '<option value="">Year</option>';
        for (let i = year_satart; i <= year_end; i++) {
            let selected = (i === year_selected ? ' selected' : '');
            option += '<option value="' + i + '"' + selected + '>' + i + '</option>';
        }
        document.getElementById("year").innerHTML = option;
    })();
  
    $(document).ready(function() {
      $('#applicant-list').DataTable( {
          "ordering": false,
          bInfo: false,
          scrollY: '700px', scrollCollapse: true, paging: false,
      });
    });

    $(document).ready(function() {
        $('#applicant-reports').DataTable( {
            "ordering": false,
            bFilter: false, 
            bInfo: false,
            scrollY: '700px', scrollCollapse: true, paging: true, searching: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel', className: 'btn btn-warning', text: 'Excel Report' },
                { extend: 'pdf', className: 'btn btn-warning', text: 'PDF Report' },
                { extend: 'print', className: 'btn btn-warning', text: 'Print Report' },
            ]
        });
    });

    $(document).ready(function() {
        $('#schedules-reports').DataTable( {
            "ordering": false,
            bFilter: false, 
            bInfo: false,
            scrollY: '700px', scrollCollapse: true, paging: true, searching: true,
            dom: 'Bfrtip',
            buttons: [
                { extend: 'excel', className: 'btn btn-warning', text: 'Generate Report' },
                { extend: 'pdf', className: 'btn btn-warning', text: 'PDF Report' },
                { extend: 'print', className: 'btn btn-warning', text: 'Print Report' },
            ]
        });
    });
    </script>
    @show
  </body>

  @section('modal')
 
  <!-- Start Examinee Results -->
    <div class="modal fade bs-example-modal-sm" id="info_results" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
               </button>
               <h4 class="modal-title">Select Transaction</h4>
              </div>
              <div class="modal-body">
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_examinee"></a> Examinee Data</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-stats" id="btn_test_result"></a> Update Test Result</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-print" id="btn_view_preenrolment"></a> Generate Pre-Enrollment</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-camera" id="btn_capture_image"></a> Capture Applicant Image</p>
                <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-check" id="btn_confirm_pre_enrolment"></a> Confirm for Pre-Enrolment</p>    
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
    </div> 
    <!-- End Examinee Results -->

  <!-- Start Applicant -->
  <div class="modal fade bs-example-modal-sm" id="tab_info_app" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to push this applicant?</h4>
          </div>
          <div class="modal-body">

            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-check" id="btn_confirm_applicant"></a> Push Applicant</p>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End  Applicant -->

  <!-- StartExaminee -->
  <div class="modal fade" id="tab_info_examinee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
           </button>
           <h4 class="modal-title">Are you sure to push this examinee?</h4>
          </div>
          <div class="modal-body">

            <p><a href="#" type="button" class="btn btn-default glyphicon glyphicon-check" id="btn_confirm_examinee"></a> Push Examinee</p>     
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
  </div> 
  <!-- End Examinee -->
  @show

</html>

