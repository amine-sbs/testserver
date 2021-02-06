<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Countrie;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
      public function hasOneRelation(){
          $user  = \App\User::with(['phone'=>function($q){
              $q->select('code','phone','user_id');
          }])->find(2);

          return response()->json($user);
      }

      public function hasOneRelationReverse(){
           $phone = Phone::with(['user'=>function($q){
               $q->select('id','name');
           }])->find(1);

           // make some attribute visible => mettre chaque  attribute visible
          $phone->makeVisible('user_id');
          // make some attribute hidden  => mettre chaque attribute invisible
          //$phone->makeHidden('code');
          return $phone;
      }

    public function getUserHasPhone(){
        return User::whereHas('phone')->get();
    }

    public function getUserNotHasPhone(){
    return User::whereDoesntHave('phone')->get();
}
    public function getUserHasPhoneWithCondition(){
        return User::whereHas('phone',function ($q){
            $q->where('code','22');
        })->get();
    }


    ######## One to many relations ship methods #########

    public function getHospitalDoctors (){

          $hospital = Hospital::find(1);//methode 2 : Hospital::where('id',1)->first();

          //return $hospital->doctors; // -> return hospital doctors

         $hospital = Hospital::with('doctors')->find(1);

        // $doctors=$hospital->doctors;

        /* foreach ($doctors as $doctor){
              echo $doctor -> name.'<br>';
         }*/

         $doctor = Doctor::find(1);
         return $doctor->hospital->name;
    }

    public function hospitals(){

        $hospitals = Hospital::select('id','name','adresse')->get();
        return view('doctors.hospital',compact('hospitals'));
    }
    public function doctors($hospital_id){
          $hospital = Hospital::find($hospital_id);
          $doctors = $hospital->doctors;

        return view('doctors.doctor',compact('doctors'));
    }

    public function hospitalsHasdoctor(){
          $hospitals = Hospital::whereHas('doctors')->get();
          return $hospitals;
    }

    public function hospitalsHasOnlyMaledoctor(){

       return $hospitals = Hospital::with('doctors')->whereHas('doctors',function($q){
            $q->where('gender',1);
        })->get();
    }

    public function hospitalsNotHasDoctor(){

          $hospital = Hospital::whereDoesntHave('doctors')->get();
          return $hospital;
    }

    public function deleteHospital($hospital_id){
         $hospital =  Hospital::find($hospital_id);
         if(!$hospital)
             return abort('404');

         //delete doctors in this hospital
        $hospital->doctors()->delete();
        $hospital->delete();

        return redirect()->route('hospital.all');

    }

     ######## relatinship Maany to Many ########

    public function getDoctorServices(){
        return $doctor = Doctor::with('services')->find(5);
         // $doctor -> services;
    }

    public function getServicesDoctor(){

        return  $doctors = Service::with('doctors')->find(1);

    }

    public function getdoctorServ($doctorid){

          $doctor = Doctor::find($doctorid);
          $services = $doctor->services;

        $doctors = Doctor::select('id','name')->get();
        $allServices = Service::select('id','name')->get();
          return view('doctors.services',compact('services','doctors','allServices'));

    }

    public function saveServicesToDoctor(Request $request)
    {

        $doctor = Doctor::find($request->doctor_id);
        if (!$doctor) {
            return abort('404');
        }
        //$doctor->services()->attach($request->servicesid);
        //$doctor->services()->sync($request->servicesid);
        $doctor->services()->syncWithoutDetaching($request->servicesid);
        return 'success';

    }

// has one through

    public function getPatientDoctor(){
          $patient = Patient::find(2);
          return $patient->doctor;
    }


    // accessors method
    public function getDoctors(){
           $doctors = Doctor::select('id','name','gender')->get();

           return $doctors;
    }


}
