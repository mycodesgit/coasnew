@extends('layouts.master_settings')

@section('title')
COAS - V1.0 || Settings
@endsection

@section('sideheader')
<h4>Settings</h4>
@endsection

@yield('style')

@yield('sidemenu')

@section('workspace')
<ol class="breadcrumb">
  <li><a href="{{ route('home') }}" class="list-group-item glyphicon glyphicon-home"></a></li>
  <li>Settings</li>
</ol>
@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
  @elseif (Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div> 
@endif

  <div class="col-md-5 jumbotron">
    <form method="post" action="{{ URL::route('createUser') }}">
        {{ csrf_field() }}
        <div class="page-header" style="margin-top: 0px;">
          <h4>Administer User</h4>
       </div>

       <div class="col-md-6" {{ ($errors->has('type')) ? 'has-error' : ''}}>
          <label><span class="label label-default">User Level</span></label>
          <select class="form-control" name="type" required="">
            <option value="">Level</option>
            <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>Guidance Officer</option>
            <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>Guidance Staff</option>
            <option value="3" @if (old('type') == 3) {{ 'selected' }} @endif>Registrar</option>
            <option value="4" @if (old('type') == 4) {{ 'selected' }} @endif>Registrar Staff</option>
            <option value="5" @if (old('type') == 5) {{ 'selected' }} @endif>College Dean</option>
            <option value="6" @if (old('type') == 6) {{ 'selected' }} @endif>Program Head</option>
            <option value="7" @if (old('type') == 7) {{ 'selected' }} @endif>College Staff</option>
          </select>
          @if ($errors->has('type'))
          <span class="label label-danger">{{ $errors->first('type') }}</span>
          @endif
        </div>

       <div class="col-md-6" {{ ($errors->has('campus')) ? 'has-error' : ''}}>
          <label><span class="label label-default">Campus</span></label>
            <select class="form-control" name="campus" required="">
            <option value="">Campus</option>
            <option value="MC" @if (old('campus') == 'MC') {{ 'selected' }} @endif>Main</option>
            <option value="SCC" @if (old('campus') == 'SCC') {{ 'selected' }} @endif>San Carlos</option>
            <option value="VC" @if (old('campus') == 'VC') {{ 'selected' }} @endif>Victorias</option>
            <option value="HC" @if (old('campus') == 'HC') {{ 'selected' }} @endif>Hinigaran</option>
            <option value="MP" @if (old('campus') == 'MP') {{ 'selected' }} @endif>Moises Padilla</option>
            <option value="HinC" @if (old('campus') == 'HinC') {{ 'selected' }} @endif>Hinobaan</option>
            <option value="SC" @if (old('campus') == 'SC') {{ 'selected' }} @endif>Sipalay</option>
            <option value="IC" @if (old('campus') == 'IC') {{ 'selected' }} @endif>Ilog</option>
            <option value="CC" @if (old('campus') == 'CC') {{ 'selected' }} @endif>Cauayan</option>
          </select>
        </div>

        <div class="col-md-12" {{ ($errors->has('department')) ? 'has-error' : ''}}>
          <label><span class="label label-default">Department</span></label>
            <select class="form-control" name="department">
            <option value="">Department</option>
            <option value="CCS" @if (old('department') == 'CCS') {{ 'selected' }} @endif>College of Computer Studies</option>
            <option value="COTED" @if (old('department') == 'COTED') {{ 'selected' }} @endif>College of Teacher Education</option>
            <option value="CCJE" @if (old('department') == 'CCJE') {{ 'selected' }} @endif>College of Criminal Justice Education</option>
            <option value="COE" @if (old('department') == 'COE') {{ 'selected' }} @endif>College of Engineering</option>
            <option value="CAF" @if (old('department') == 'CAF') {{ 'selected' }} @endif>College of Agriculture and Forestry</option>
            <option value="CBM" @if (old('department') == 'CBM') {{ 'selected' }} @endif>College of Business Management</option>
            <option value="Guidance Office" @if (old('department') == 'Guidance Office') {{ 'selected' }} @endif>Guidance Office</option>
            <option value="Registrar Office" @if (old('department') == 'Registrar Office') {{ 'selected' }} @endif>Registrar Office</option>
            <option value="Assessment Office" @if (old('department') == 'Assessment Office') {{ 'selected' }} @endif>Assessment Office</option>
            <option value="Scholarship Office" @if (old('department') == 'Scholarship Office') {{ 'selected' }} @endif>Scholarship Office</option>
            <option value="Cashier Office" @if (old('department') == 'Cashier Office') {{ 'selected' }} @endif>Cashier Office</option>
            <option value="Graduate School Registar" @if (old('department') == 'Graduate School Registar') {{ 'selected' }} @endif>Graduate School Registar</option>
          </select>
        </div>

        <div class="col-md-6" {{ ($errors->has('lastname')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Lastname</span></label>
        <input type="text" name="lastname" style="text-transform: uppercase;" class="form-control" value="{{old('lastname')}}">
        @if ($errors->has('lastname'))
        <span class="label label-danger">{{ $errors->first('lastname') }}</span>
        @endif
      </div>
      <div class="col-md-6" {{ ($errors->has('firstname')) ? 'has-error' : ''}}>
        <label><span class="label label-default">Firstname</span></label>
        <input type="text" name="firstname" style="text-transform: uppercase;" class="form-control" value="{{old('firstname')}}">
        @if ($errors->has('firstname'))
        <span class="label label-danger">{{ $errors->first('firstname') }}</span>
        @endif
      </div>
      <div class="col-md-6">
        <label><span class="label label-default">Middlename</span></label>
        <input type="text" name="middlename" style="text-transform: uppercase;" class="form-control" value="{{old('middlename')}}">
      </div>

      <div class="col-md-6">
      <label><span class="label label-default">Ext.</span></label>
      <select class="form-control" name="ext">
          <option value="">N/A</option>
          <option value="Jr." @if (old('ext') == "Jr.") {{ 'selected' }} @endif>Jr.</option>
          <option value="Sr." @if (old('ext') == "Sr.") {{ 'selected' }} @endif>Sr.</option>
          <option value="III" @if (old('ext') == "III") {{ 'selected' }} @endif>III</option>
          <option value="IV" @if (old('ext') == "IV") {{ 'selected' }} @endif>IV</option>  
        </select>
      </div>

        <div class="col-md-6">
          <div class="form-group" {{ ($errors->has('email')) ? 'has-error' : ''}}>
           <label><span class="label label-default">Email Address</span></label>
           <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}">
              @if($errors->has('email'))
            {{ $errors->first('email') }}
              @endif
          </div>
      </div>

      <div class="col-md-6">
         <div class="form-group" {{ ($errors->has('password')) ? 'has-error' : ''}}>
         <label><span class="label label-default">Password</span></label>
         <input class="form-control" type="password" name="password" id="password" placeholder="Enter Password">
         @if($errors->has('password'))
          {{ $errors->first('password') }}
            @endif
         </div>
         </div>

         <div class="col-md-12">
            <div class="text-center">
              <button type="submit" class="col-md-12 btn btn-warning">Add Account</button>
            </div>
        </div>

    </form>
  </div>

  <div class="col-md-7">
    <div class="scrollme">
        <table id="userSettings" class="display nowrap" style="width:100%">
          <thead>
                <tr>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Campus</th>
                    <th>Action</th>
                </tr>
            </thead>
             <tbody>
              @foreach ($users as $user)
                @if (Auth::user()->isAdmin == $user->isAdmin)
                @else
                <tr style="text-transform: uppercase;">
                  <td>{{$user->lname}} {{$user->fname}} @if($user->mname == null) @else {{ substr($user->mname,0,1) }}.@endif @if($user->ext == 'N/A') @else{{$user->ext}}@endif</td>
                  <td>@if ($user->isAdmin == 1) Guidance Officer @elseif($user->isAdmin == 2) Guidance Staff @elseif($user->isAdmin == 3) Registrar @elseif($user->isAdmin == 4) Registrar Staff @elseif($user->isAdmin == 5) College Dean @elseif($user->isAdmin == 6) Program Head @elseif($user->isAdmin == 7) College Staff @endif</td>
                  <td>{{ $user->dept }}</td>
                  <td style="text-align:center;">
                      <a data-toggle="tooltip" data-placement="bottom" title="Process Applicant"><i id="{{ $user->id }}" data-toggle="modal" data-target="#user_settings" class="btn btn-green glyphicon glyphicon-tasks settings"></i></a>
                      </td>
                  </tr>   
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#userSettings').DataTable( {
        "ordering": false,
        scrollY: '420px', scrollCollapse: true, paging: false,
      });
  });
  </script>
@endsection


<!-- Start Configure Users -->
<div class="modal fade bs-example-modal-sm" id="user_settings" tabindex="-1" role="dialog" aria-hidden="true">
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
            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-pencil" id="btn_edit_user"></a> Edit User Data</p>
            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-lock" id="btn_changepass_user"></a> Change Password</p>
            <p><a href="#" type="button" class="btn btn-green glyphicon glyphicon-trash" id="btn_delete_account"></a> Remove User</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
</div> 
<!-- End Configure Users -->
