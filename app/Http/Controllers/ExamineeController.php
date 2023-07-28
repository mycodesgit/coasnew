<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\ApplicantDocs;
use App\Models\ExamineeResult;
use App\Models\Programs;
use App\Models\Strands;
use App\Models\AdmissionDate;
use App\Models\Time;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class ExamineeController extends Controller
{
	public function examinee_list()
    {
        $examinees = Applicant::orderBy('admission_id', 'desc')->where('p_status', '=', 2)->get();
        $admissionid = Applicant::orderBy('admission_id', 'desc')->first();
        return view('admission.examinee.list')
        ->with('admissionid', $admissionid)
        ->with('examinees', $examinees);
    }
    public function srchexamineeList(Request $request)
    {
        $data = Applicant::where('p_status', '=', 2)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->admission_id){$data = $data->where('admission_id',$request->admission_id);}
        if ($request->lname){$data = $data->where('lname',$request->lname);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.examinee.list_search', ['data' => $data,'totalSearchResults' => $totalSearchResults] );
    }

    public function assignresult($id)
    {
        $assignresult = Applicant::findOrFail($id);
        $assign = ExamineeResult::where('admission_id', '=', $assignresult->admission_id)->get();
        $per = ExamineeResult::where('admission_id', '=', $assignresult->admission_id)->get();
        return view('admission.examinee.result')->with('assignresult',$assignresult )->with('assign',$assign)->with('per',$per);
    }

    public function examinee_delete($id)
    {
        $examinee = Applicant::findOrFail($id);
        if ($examinee == null){return redirect('admission/')->with('fail', 'The Applicant does not exist.');}
        if ($examinee->delete())
        {
            $docts = ApplicantDocs::where('admission_id','=', $examinee->admission_id)->delete();

            $docts = ExamineeResult::where('admission_id','=', $examinee->admission_id)->delete();

            return back()->with('success', 'The Applicant was successfully deleted.');}
            else{

            return back()->with('fail', 'An error was occured while deleting the data.');
        }
    }

    public function examinee_result_save(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'raw_score' => 'required|numeric',
            'percentile' => 'required|numeric',
        ]);
        if($validator->fails()){
            return Redirect::route('assignresult', $id)->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');}
        else{

        $examinee = Applicant::findOrFail($id);
        $assign = ExamineeResult::where('admission_id', $examinee->admission_id)
        ->update([
            'raw_score' => $request->input('raw_score'), 
            'percentile' => $request->input('percentile'),
        ]);
        return Redirect::route('assignresult', $id)->with('success','The examinee result has been saved');
        }
    }

    public function examinee_result_save_nd(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'raw_score' => 'required|numeric',
            'percentile' => 'required|numeric',
        ]);
        
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput()->with('fail', 'Error in saving data. Please check the inputs!');
        }
        else
        {
            $examinee = Applicant::findOrFail($id);
            $assign = ExamineeResult::where('admission_id', $examinee->admission_id)
            ->update([
                'raw_score' => $request->input('raw_score'), 
                'percentile' => $request->input('percentile'),
            ]);
            return Redirect::back()->with('success','The examinee result has been updated');
        }
    }

    public function examinee_confirm($id)
    {
        $examinee = Applicant::findOrFail($id);
        if ($examinee->result->raw_score == null && $examinee->result->percentile == null)
        {
            return Redirect::route('examinee_edit', $id)->with('fail','Please assign result before pushing to results');
        }
        else
        {
            $examinee->p_status = 3;
            $dt = Carbon::now();  
            $examinee->updated_at = $dt;
            $examinee->update();
            return Redirect::route('srchexamineeResultList')->with('success','Examinee result has been updated'); 
        }

    }

    public function result_list()
    {
       $examinees = Applicant::orderBy('admission_id', 'desc')->where('p_status', '=', 3)->get();
        return view('admission.examinee.result_list')
        ->with('examinees', $examinees);
    }
    public function srchexamineeResultList(Request $request)
    {
        $data = Applicant::where('p_status', '=', 3)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->admission_id){$data = $data->where('admission_id',$request->admission_id);}
        if ($request->lname){$data = $data->where('lname',$request->lname);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.examinee.result_search', ['data' => $data,'totalSearchResults' => $totalSearchResults] );
    }
    public function applicant_confirm($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->p_status = 2;
        $dt = Carbon::now();  
        $applicant->updated_at = $dt;
        $applicant->update();
        return back()->with('success', 'Applicant was officially confirmed for examination');
    }
    public function confirmPreEnrolment($id)
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->p_status = 4;
        $dt = Carbon::now();  
        $applicant->updated_at = $dt;
        $applicant->update();
        return back()->with('success', 'Applicant was officially confirmed for Pre-Enrolment');
    }
    public function examinee_edit($id)
    {
        $year = Carbon::now()->format('Y');
        $applicant = Applicant::find($id);
        $docs = ApplicantDocs::where('admission_id', '=', $applicant->admission_id)->get();
        $program = Programs::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $strand = Strands::orderBy('id', 'asc')->where('campus', '=', Auth::user()->campus)->get();
        $date = AdmissionDate::select('date', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('date')->get();
        $time = Time::select('time', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('time')->get();
        $venue = Venue::select('venue', DB::raw('count(*) as total'))->where('campus', '=', Auth::user()->campus)->groupBy('venue')->get();
        return view('admission.examinee.edit')
        ->with('applicant', $applicant)
        ->with('docs', $docs)
        ->with('program', $program)
        ->with('strand', $strand)
        ->with('date', $date)
        ->with('time', $time)
        ->with('venue', $venue);
    }

    public function applicant_update_nd(Request $request, $id)
    {
        $data = request()->all();
        $applicant = Applicant::findOrFail($id);
        $applicant->age = $request->input('age');
        $applicant->contact = $request->input('contact');
        $applicant->address = $request->input('address');
        $applicant->email = $request->input('email');
        $applicant->strand = $request->input('strand');
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

        return Redirect::route('examinee_edit', $id)->with('success','Examinee data has been updated');
    }
}
