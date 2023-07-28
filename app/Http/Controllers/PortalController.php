<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\ApplicantDocs;
use App\Models\ExamineeResult;
use App\Models\DeptRating;
use App\Models\Programs;
use App\Models\Strands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function index()
    {
    	return view('portal.index');
    }

    public function admission_apply()
    {
    	$admissionid = Applicant::orderBy('admission_id', 'desc')->first();
        $program = Programs::orderBy('id', 'asc')->get();
        $strand = Strands::orderBy('id', 'asc')->get();
    	return view('portal.apply')
        ->with('admissionid', $admissionid)
        ->with('program', $program)
        ->with('strand', $strand);
    }
    public function post_admission_apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admissionid' => 'required|unique:ad_applicant_admission,admission_id|numeric',
            'type' => 'required',
            'campus' => 'required',
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
            return Redirect::route('admission-apply')->withErrors($validator)->withInput()->with('fail', 'Error in saving applicant data. Please check the inputs!');}
        else{
            $year = Carbon::now()->format('Y');
            $applicant = new Applicant;
            $applicant->year = $year;
            $applicant->campus = $request->input('campus');
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
            $applicant->strand = $request->input('strand');  
            $applicant->lstsch_attended = $request->input('lstsch_attended');
            $applicant->strand = $request->input('strand');
            $applicant->suc_lst_attended = $request->input('suc_lst_attended');
            $applicant->course = $request->input('course');
            $applicant->preference_1 = $request->input('preference_1');
            $applicant->preference_2 = $request->input('preference_2');
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

            return Redirect::route('admission-data-current')->withInput()->with('success', 'Application was successfully submitted. Check status in the (Track) Admission Page. Admission ID served as username!');}
            else{
                return Redirect::route('admission-apply')->withErrors($validator)->withInput();}
        }
    }
    public function admission_data_current()
    {
        $applicant = Applicant::orderBy('admission_id', 'desc')->first();
        return view('portal.admission_current')->with('applicant', $applicant);
    }
    public function admission_track()
    {
        return view('portal.admission_current');
    }

    public function admission_track_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admission_id' => 'required|numeric|min:7',
        ]);

        if($validator->fails()){
            return Redirect::route('admission-track')->withErrors($validator)->withInput()->with('fail', 'Please check the inputs! (e.g. 202300001)');}
        else
        {

            $data = Applicant::get();
            if (Applicant::where('admission_id', '=', request('admission_id'))->exists())
            {
                $data = $data->where('admission_id', '=', $request->admission_id);
                $request->session()->put('recent_search', $data);
                return view('portal.track', ['data' => $data]);
                
            }
            else
            {
                return back()->withInput()->with('fail', 'Admission ID not found!');
            }
        
        }
    }
}
