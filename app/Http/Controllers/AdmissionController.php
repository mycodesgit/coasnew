<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\ApplicantDocs;
use App\Models\ExamineeResult;
use App\Models\DeptRating;
use App\Models\Programs;
use App\Models\Strands;
use App\Models\AdmissionDate;
use App\Models\Time;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    public function index()
    {
        return view('admission.index');
    }

    public function applicant_list()
    {
        $applicants = Applicant::orderBy('admission_id', 'desc')->get();
        $admissionid = Applicant::orderBy('admission_id', 'desc')->first();
        return view('admission.applicant.list')
        ->with('admissionid', $admissionid)
        ->with('applicants', $applicants);
    }

    public function applicant_add()
    {
        $admissionid = Applicant::orderBy('admission_id', 'desc')->first();
        $program = Programs::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $strand = Strands::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $date = AdmissionDate::select('date', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('date')->get();
        $time = Time::select('time', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('time')->get();
        $venue = Venue::select('venue', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('venue')->get();
        return view('admission.applicant.add')
        ->with('admissionid', $admissionid)
        ->with('program', $program)
        ->with('strand', $strand)
        ->with('date', $date)
        ->with('time', $time)
        ->with('venue', $venue);
    }

    public function post_applicant_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admissionid' => 'required|unique:ad_applicant_admission,admission_id|numeric',
            'type' => 'required',
            'lastname' => 'required|max:191',
            'firstname' => 'required|max:191',
            'email' => 'required|unique:ad_applicant_admission,email|max:191',
            'gender' => 'required',
            'age' => 'required',
            'contact' => 'required|numeric|min:11',
            'preference_1' => 'required',
            'preference_2' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::route('applicant-add')->withErrors($validator)->withInput()->with('fail', 'Error in saving applicant data. Please check the inputs!');}
        else{
            $year = Carbon::now()->format('Y');
            $applicant = new Applicant;
            $applicant->year = $year;
            $applicant->campus = Auth::user()->campus;
            $applicant->admission_id = $request->input('admissionid');
            $applicant->type = $request->input('type');
            $applicant->lname = $request->input('lastname');
            $applicant->fname = $request->input('firstname');
            $applicant->mname = $request->input('mname');
            $applicant->ext = $request->input('ext');
            $applicant->gender = $request->input('gender');
            $applicant->address = $request->input('address');
            $applicant->bday = $request->input('bday');
            $applicant->age = $request->input('age');
            $applicant->contact = $request->input('contact');
            $applicant->email = $request->input('email'); 
            $applicant->lstsch_attended = $request->input('lstsch_attended');
            $applicant->strand = $request->input('strand');
            $applicant->suc_lst_attended = $request->input('suc_lst_attended');
            $applicant->course = $request->input('course');
            $applicant->preference_1 = $request->input('preference_1');
            $applicant->preference_2 = $request->input('preference_2');
            $applicant->d_admission = $request->input('d_admission');
            $applicant->time = $request->input('time');
            $applicant->venue = $request->input('venue');
            $dt = Carbon::now();  
            $applicant->created_at = $dt;
            $applicant->save();

            if ($applicant->save()){
             $docs = new ApplicantDocs;
             $docs->admission_id = $applicant->admission_id;
             $docs->r_card = $request->input('r_card');
             $docs->g_moral = $request->input('g_moral');
             $docs->t_record = $request->input('t_record');
             $docs->b_cert = $request->input('b_cert');
             $docs->h_dismissal = $request->input('h_dismissal');
             $docs->m_cert = $request->input('m_cert');
             $docs->created_at = $dt;
             $docs->save();

             $examinee = new ExamineeResult;
             $examinee->admission_id =  $applicant->admission_id;
             $examinee->raw_score = $request->input('raw_score');
             $examinee->percentile = $request->input('percentile');
             $examinee->created_at = $dt;
             $examinee->save();

             $examinee = new DeptRating;
             $examinee->admission_id =  $applicant->admission_id;
             $examinee->created_at = $dt;
             $examinee->save();

            return redirect('emp/admission/applicant/add')->with('success', 'Applicant has been successfully created.');}
            else{
                return Redirect::route('admission-index')->withErrors($validator)->withInput();}
        }

    }
    public function applicant_edit($id)
    {
        $applicant = Applicant::find($id);
        $year = Carbon::now()->format('Y');
        $admissionid = Applicant::orderBy('admission_id', 'desc')->first();
        $program = Programs::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $strand = Strands::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $date = AdmissionDate::select('date', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('date')->get();
        $time = Time::select('time', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('time')->get();
        $venue = Venue::select('venue', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('venue')->get();
        $date1 = AdmissionDate::select('date', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('date')->get();
        $time1 = Time::select('time', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('time')->get();
        $venue1 = Venue::select('venue', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('venue')->get();
        $docs = ApplicantDocs::where('admission_id', '=', $applicant->admission_id)->get();
        return view('admission.applicant.edit')
        ->with('applicant', $applicant)
        ->with('docs', $docs)
        ->with('program', $program)
        ->with('strand', $strand)
        ->with('date', $date)
        ->with('date1', $date1)
        ->with('time', $time)
        ->with('venue', $venue)
        ->with('time1', $time1)
        ->with('venue1', $venue1);
    }
    public function applicant_schedule($id)
    {
        $applicant = Applicant::find($id);
        $docs = ApplicantDocs::where('admission_id', '=', $applicant->admission_id)->get();
        $date = AdmissionDate::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $time = Time::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $venue = Venue::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        return view('admission.applicant.schedule')
        ->with('applicant', $applicant)
        ->with('docs', $docs)
        ->with('date', $date)
        ->with('time', $time)
        ->with('venue', $venue);
    }
    public function applicant_delete($id)
    {
        $applicant = Applicant::findOrFail($id);
        if ($applicant == null){return redirect('admission/')->with('fail', 'The Applicant does not exist.');}
        if ($applicant->delete()){$docts = ApplicantDocs::where('admission_id','=', $applicant->admission_id)->delete();return back()->with('success', 'The Applicant was successfully deleted.');}else{return back()->with('fail', 'An error was occured while deleting the data.');}
    }
    public function applicant_confirm($id)
    {
        $applicant = Applicant::findOrFail($id);

        if ($applicant->d_admission == null && $applicant->time == null)
        {
            return Redirect::route('applicant_edit', $id)->with('fail','Please assign schedule and time for examination before pushing to examination list');
        }
        else
        {
            $applicant->p_status = 2;
            $dt = Carbon::now();  
            $applicant->updated_at = $dt;
            $applicant->update();
            return Redirect::route('examinee_edit', $id)->with('success','Applicant data has been updated'); 
        }
        
    }
    public function srchappList(Request $request)
    {
        $data = Applicant::where('p_status', '=', 1)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->admission_id){$data = $data->where('admission_id',$request->admission_id);}
        if ($request->lname){$data = $data->where('lname',$request->lname);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.applicant.list_search', ['data' => $data,'totalSearchResults' => $totalSearchResults] );
    }
    public function applicant_update(Request $request, $id)
    {
        $data = request()->all();
        $applicant = Applicant::findOrFail($id);
        $applicant->age = $request->input('age');
        $applicant->contact = $request->input('contact');
        $applicant->address = $request->input('address');
        $applicant->email = $request->input('email');
        $applicant->suc_lst_attended = $request->input('suc_lst_attended');
        $applicant->course = $request->input('course');
        $applicant->d_admission = $request->input('d_admission');
        $applicant->time = $request->input('time');
        $applicant->venue = $request->input('venue');
        $applicant->update($data);

        $docs = ApplicantDocs::where('admission_id', $applicant->admission_id)
        ->update([
            'r_card' => $request->input('r_card'), 
            'g_moral' => $request->input('g_moral'),
            'b_cert' => $request->input('b_cert'),
            'm_cert' => $request->input('m_cert'),
            't_record' => $request->input('t_record'),
            'h_dismissal' => $request->input('h_dismissal'),
        ]);

        return Redirect::route('applicant_edit', $id)->with('success','Applicant data has been updated');
    }
    public function applicant_schedule_save(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->d_admission = $request->input('d_admission');
        $applicant->time = $request->input('time');
        $applicant->venue = $request->input('venue');
        $applicant->update();
        return Redirect::route('applicant_edit', $id)->with('success','Applicant schedule has been saved');
    }
    public function slots()
    {
        $year = Carbon::now()->format('Y');
        $admissionid = Applicant::orderBy('admission_id', 'desc')->first();
        $date =  DB::table('ad_admission_date')->select('date', DB::raw('count(*) as total'))->orderBy('id', 'asc')->groupBy('date')->get();
        return view('admission.applicant.slots')
        ->with('admissionid', $admissionid)
        ->with('date', $date);
    }

    public function configure_admission()
    {
        $program = Programs::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $strand = Strands::orderBy('id', 'asc')->get();
        $date = AdmissionDate::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $dates = AdmissionDate::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $time = Time::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $venue = Venue::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        return view('admission.configure.index')
        ->with('program', $program)
        ->with('strand', $strand)
        ->with('date', $date)
        ->with('dates', $dates)
        ->with('time', $time)
        ->with('venue', $venue);
    }

    public function add_Program(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'code' => 'required',
            'program' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::route('configure_admission')->withErrors($validator)->withInput()->with('fail', 'Error in saving program data. Please check the inputs!');}
        else{

            $program = new Programs;
            $program->campus = Auth::user()->campus;
            $program->code = $request->input('code');
            $program->program = $request->input('program');
            $dt = Carbon::now();  
            $program->created_at = $dt;
            $program->save();

            return Redirect::route('configure_admission')->with('success', 'Program Data has been successfully created.');
        }
    }

    public function add_Strand(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'code' => 'required',
            'strand' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::route('configure_admission')->withErrors($validator)->withInput()->with('fail', 'Error in saving strand data. Please check the inputs!');}
        else{

            $strand = new Strands;
            $strand->campus = Auth::user()->campus;
            $strand->code = $request->input('code');
            $strand->strand = $request->input('strand');
            $dt = Carbon::now();  
            $strand->created_at = $dt;
            $strand->save();

            return Redirect::route('configure_admission')->with('success', 'Strand Data has been successfully created.');
        }
    }

    public function add_admission_date(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::route('configure_admission')->withErrors($validator)->withInput()->with('fail', 'Error in saving admission schedule. Please check the inputs!');}
        else{

            $date = new AdmissionDate;
            $date->campus = Auth::user()->campus;
            $date->date = $request->input('date');
            $dt = Carbon::now();  
            $date->created_at = $dt;
            $date->save();
            
            return Redirect::route('configure_admission')->with('success', 'Admission schedule has been successfully created.');}
    }

    public function edit_program($id)
    {
        $program = Programs::find($id);
        $programs = Programs::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $strand = Strands::orderBy('id', 'asc')->get();
        $date = AdmissionDate::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        return view('admission.configure.editProgram')
        ->with('program', $program)
        ->with('programs', $programs)
        ->with('strand', $strand)
        ->with('date', $date);
    }

    public function programEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'program' => 'required',
        ]);
        
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');
        }
        else
        {
            $program = Programs::findOrFail($id)
            ->update([
                'code' => $request->input('code'), 
                'program' => $request->input('program'),
            ]);
            return Redirect::route('configure_admission')->with('success','The program data has been updated');
        }
    }

    public function programDelete($id)
    {
        $program = Programs::findOrFail($id);

        if ($program == null)
        {
            return back()->with('fail', 'The program data does not exist.');
        }
        if ($program->delete())
        {
            return Redirect::route('configure_admission')->with('success', 'The program data was successfully deleted.');
        }
        else
        {
            return back()->with('fail', 'An error was occured while deleting the data.');
        }
    }

    public function edit_strand($id)
    {
        $strand = Strands::find($id);
        $strands = Strands::orderBy('id', 'asc')->get();
        return view('admission.configure.editStrand')
        ->with('strand', $strand)
        ->with('strands', $strands);
    }

    public function strandEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'strand' => 'required',
        ]);
        
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');
        }
        else
        {
            $strand = Strands::findOrFail($id)
            ->update([
                'code' => $request->input('code'), 
                'strand' => $request->input('strand'),
            ]);
            return Redirect::route('configure_admission')->with('success','The strand data has been updated');
        }
    }

    public function strandDelete($id)
    {
        $strand = Strands::findOrFail($id);

        if ($strand == null)
        {
            return back()->with('fail', 'The strand data does not exist.');
        }
        if ($strand->delete())
        {
            return Redirect::route('configure_admission')->with('success', 'The strand data was successfully deleted.');
        }
        else
        {
            return back()->with('fail', 'An error was occured while deleting the data.');
        }
    }

    public function edit_date($id)
    {
        $date = AdmissionDate::find($id);
        $dates = AdmissionDate::orderBy('id', 'asc')->get();
        return view('admission.configure.editDate')
        ->with('date', $date)
        ->with('dates', $dates);
    }

    public function dateEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
        ]);
        
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');
        }
        else
        {
            $date = AdmissionDate::findOrFail($id)
            ->update([
                'date' => $request->input('date'), 
            ]);
            return Redirect::route('configure_admission')->with('success','The date data has been updated');
        }
    }

    public function dateDelete($id)
    {
        $date = AdmissionDate::findOrFail($id);

        if ($date == null)
        {
            return back()->with('fail', 'The strand data does not exist.');
        }
        if ($date->delete())
        {
            return Redirect::route('configure_admission')->with('success', 'The date data was successfully deleted.');
        }
        else
        {
            return back()->with('fail', 'An error was occured while deleting the data.');
        }
    }

    public function add_admission_time(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'time' => 'required',
            'slots' => 'required',
            'date' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::route('configure_admission')->withErrors($validator)->withInput()->with('fail', 'Error in saving admission schedule. Please check the inputs!');}
        else{

            $time = new Time;
            $time->campus = Auth::user()->campus;
            $time->date = $request->input('date');
            $time->slots = $request->input('slots');
            $time->time = $request->input('time');
            $dt = Carbon::now();  
            $time->created_at = $dt;
            $time->save();
            
            return Redirect::route('configure_admission')->with('success', 'Admission time has been successfully created.');}
    }

    public function edit_time($id)
    {
        $time = Time::find($id);
        $times = Time::orderBy('id', 'asc')->get();
        $dates = AdmissionDate::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        return view('admission.configure.editTime')
        ->with('time', $time)
        ->with('times', $times)
        ->with('dates', $dates);
    }

    public function timeEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'date' => 'required',
            'slots' => 'required',
        ]);
        
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');
        }
        else
        {
            $time = Time::findOrFail($id)
            ->update([
                'date' => $request->input('date'),
                'slots' => $request->input('slots'),  
                'time' => $request->input('time'),      
            ]);
            return Redirect::route('configure_admission')->with('success','The time data has been updated');
        }
    }

    public function timeDelete($id)
    {
        $time = Time::findOrFail($id);

        if ($time == null)
        {
            return back()->with('fail', 'The time data does not exist.');
        }
        if ($time->delete())
        {
            return Redirect::route('configure_admission')->with('success', 'The time data was successfully deleted.');
        }
        else
        {
            return back()->with('fail', 'An error was occured while deleting the data.');
        }
    }

    public function add_admission_venue(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'venue' => 'required',
        ]);

        if($validator->fails()){
            return Redirect::route('configure_admission')->withErrors($validator)->withInput()->with('fail', 'Error in saving admission venue. Please check the inputs!');}
        else{

            $time = new Venue;
            $time->campus = Auth::user()->campus;
            $time->venue = $request->input('venue');
            $dt = Carbon::now();  
            $time->created_at = $dt;
            $time->save();
            
            return Redirect::route('configure_admission')->with('success', 'Admission venue has been successfully created.');}
    }

    public function edit_venue($id)
    {
        $venue = Venue::find($id);
        $venues = Venue::orderBy('id', 'asc')->get();
        return view('admission.configure.editVenue')
        ->with('venue', $venue)
        ->with('venues', $venues);
    }

    public function venueEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'venue' => 'required',
        ]);
        
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');
        }
        else
        {
            $venue = Venue::findOrFail($id)
            ->update([
                'venue' => $request->input('venue'),   
            ]);
            return Redirect::route('configure_admission')->with('success','The venue data has been updated');
        }
    }

    public function venueDelete($id)
    {
        $venue = Venue::findOrFail($id);

        if ($venue == null)
        {
            return back()->with('fail', 'The venue data does not exist.');
        }
        if ($venue->delete())
        {
            return Redirect::route('configure_admission')->with('success', 'The venue data was successfully deleted.');
        }
        else
        {
            return back()->with('fail', 'An error was occured while deleting the data.');
        }
    }
}
