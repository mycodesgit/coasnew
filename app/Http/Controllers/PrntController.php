<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\Applicant;
use App\Models\ApplicantDocs;
use App\Models\ExamineeResult;
use App\Models\DeptRating;
use App\Models\Strands;
use App\Models\AdmissionDate;
use App\Models\Time;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PrntController extends Controller
{
   public function applicant_genPDF(Request $request, $id)
   {
      $applicant = Applicant::findOrFail($id); 
      view()->share('applicant',$applicant);
      $pdf = PDF::loadView('admission.applicant.print');
      return $pdf->stream();
      return view('admission.applicant.printView')->with('applicant', $applicant);
   }
   public function applicant_print(Request $request, $id)
   {
      $applicant = Applicant::findOrFail($id);
      return view('admission.applicant.printView')->with('applicant', $applicant);
   }

   public function applicant_permit(Request $request, $id)
   {
      $applicant = Applicant::findOrFail($id); 
      return view('admission.applicant.printPermit')->with('applicant', $applicant);
   }
   public function applicant_genPermit(Request $request, $id)
   {
      $applicant = Applicant::findOrFail($id); 
      view()->share('applicant',$applicant);
      $pdf = PDF::loadView('admission.applicant.printViewPermit');
      return $pdf->stream();
      return view('admission.applicant.printPermit')->with('applicant', $applicant);
   }

   public function pre_enrolment_print(Request $request, $id)
   {
      $examinee = Applicant::findOrFail($id); 
      return view('admission.examinee.printPreEnrolmentView')->with('examinee', $examinee);
   }
   public function genPreEnrolment(Request $request, $id)
   {
      $examinee = Applicant::findOrFail($id); 
      view()->share('examinee',$examinee); 
      $pdf = PDF::loadView('admission.examinee.genPreEnrolment')->setPaper('Legal', 'portrait');
      return $pdf->stream();
      return view('admission.examinee.printPreEnrolmentView')->with('examinee', $examinee);
   }
   public function applicant_printing()
   {
      $strand = Strands::orderBy('id', 'asc')->get();
      return view('admission.reports.applicant')
      ->with('strand', $strand);
   }
   public function applicant_reports(Request $request)
   {
       $min = strtotime($request->input('min_date'));
       $new_min = date('Y-m-d H:i:s', $min); 

       $max = strtotime($request->input('max_date'));
       $new_max = date('Y-m-d H:i:s', $max); 

      $strand = Strands::orderBy('id', 'asc')->get();

      $data = Applicant::where('p_status', '!=', 6)->get();
      if ($request->year){$data = $data->where('year',$request->year);}
      if ($request->campus){$data = $data->where('campus',$request->campus);}
      if ($request->strand){$data = $data->where('strand',$request->strand);}
      if ($request->min_date){$data = $data->whereBetween('created_at', [$new_min , $new_max]);}
      $request->session()->put('recent_search', $data);
      $totalSearchResults = count($data);
      return view('admission.reports.applicantgen', ['data' => $data,'totalSearchResults' => $totalSearchResults])
      ->with('strand', $strand);
   }
   public function examination_printing()
   {  
      $strand = Strands::orderBy('id', 'asc')->get();
      return view('admission.reports.examination')
      ->with('strand', $strand);
   }
  public function examination_reports(Request $request)
   {
         $min = strtotime($request->input('min_date'));
         $new_min = date('Y-m-d H:i:s', $min); 

         $max = strtotime($request->input('max_date'));
         $new_max = date('Y-m-d H:i:s', $max);

        $strand = Strands::orderBy('id', 'asc')->get();

        $data = Applicant::where('p_status', '=', 2)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        if ($request->min_date){$data = $data->whereBetween('updated_at', [$new_min , $new_max]);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.reports.examinationgen', ['data' => $data,'totalSearchResults' => $totalSearchResults])
        ->with('strand', $strand);
   }
   public function qualified_printing()
   {
        $strand = Strands::orderBy('id', 'asc')->get();
        return view('admission.reports.qualified')
        ->with('strand', $strand);
   }
   public function qualified_reports(Request $request)
   {
       $min = strtotime($request->input('min_date'));
       $new_min = date('Y-m-d H:i:s', $min); 

       $max = strtotime($request->input('max_date'));
       $new_max = date('Y-m-d H:i:s', $max); 
       $strand = Strands::orderBy('id', 'asc')->get();

        $data = Applicant::where('p_status', '=', 3)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        if ($request->min_date){$data = $data->whereBetween('updated_at', [$new_min , $new_max]);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.reports.qualifiedgen', ['data' => $data,'totalSearchResults' => $totalSearchResults])
        ->with('strand', $strand);
   }
   public function accepted_printing()
   {
        $strand = Strands::orderBy('id', 'asc')->get();
        return view('admission.reports.accepted')
        ->with('strand', $strand);
   }
   public function accepted_reports(Request $request)
   {
         $min = strtotime($request->input('min_date'));
         $new_min = date('Y-m-d H:i:s', $min); 

         $max = strtotime($request->input('max_date'));
         $new_max = date('Y-m-d H:i:s', $max); 

         $strand = Strands::orderBy('id', 'asc')->get();

        $data = Applicant::where('p_status', '!=', 6)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        if ($request->min_date){$data = $data->whereBetween('updated_at', [$new_min , $new_max]);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.reports.acceptedgen', ['data' => $data,'totalSearchResults' => $totalSearchResults])
        ->with('strand', $strand);
   }
   public function confirm_printing()
   {
        $strand = Strands::orderBy('id', 'asc')->get();
        return view('admission.reports.confirm')
        ->with('strand', $strand);
   }
   public function confirm_reports(Request $request)
   {
         $min = strtotime($request->input('min_date'));
         $new_min = date('Y-m-d H:i:s', $min); 

         $max = strtotime($request->input('max_date'));
         $new_max = date('Y-m-d H:i:s', $max); 

         $strand = Strands::orderBy('id', 'asc')->get();

        $data = Applicant::where('p_status', '=', 4)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        if ($request->min_date){$data = $data->whereBetween('updated_at', [$new_min , $new_max]);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.reports.confirmgen', ['data' => $data,'totalSearchResults' => $totalSearchResults])
        ->with('strand', $strand);
   }

   public function schedules_printing()
   {
        $strand = Strands::orderBy('id', 'asc')->get();
        $date = AdmissionDate::select('date', DB::raw('count(*) as total'))->groupBy('date')->get();
        $time = Time::select('time', DB::raw('count(*) as total'))->groupBy('time')->get();
        $venue = Venue::select('venue', DB::raw('count(*) as total'))->groupBy('venue')->get();
        return view('admission.reports.schedules')
        ->with('strand', $strand)
        ->with('date', $date)
        ->with('time', $time)
        ->with('venue', $venue);
   }
   public function schedules_reports(Request $request)
   {
       $min = strtotime($request->input('min_date'));
       $new_min = date('Y-m-d H:i:s', $min); 

       $max = strtotime($request->input('max_date'));
       $new_max = date('Y-m-d H:i:s', $max); 

        $strand = Strands::orderBy('id', 'asc')->get();
        $date = AdmissionDate::select('date', DB::raw('count(*) as total'))->groupBy('date')->get();
        $time = Time::select('time', DB::raw('count(*) as total'))->groupBy('time')->get();
        $venue = Venue::select('venue', DB::raw('count(*) as total'))->groupBy('venue')->get();

        $data = Applicant::where('p_status', '=', 2)->orWhere('p_status', '=', 1)->get();
        if ($request->year){$data = $data->where('year',$request->year);}
        if ($request->campus){$data = $data->where('campus',$request->campus);}
        if ($request->date){$data = $data->where('d_admission',$request->date);}
        if ($request->time){$data = $data->where('time',$request->time);}
        if ($request->venue){$data = $data->where('venue',$request->venue);}
        if ($request->strand){$data = $data->where('strand',$request->strand);}
        if ($request->min_date){$data = $data->whereBetween('created_at', [$new_min , $new_max]);}
        $request->session()->put('recent_search', $data);
        $totalSearchResults = count($data);
        return view('admission.reports.schedulesgen', ['data' => $data,'totalSearchResults' => $totalSearchResults])
        ->with('strand', $strand)
        ->with('date', $date)
        ->with('time', $time)
        ->with('venue', $venue);
   }
}

