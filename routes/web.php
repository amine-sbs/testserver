<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Mail\NotifyEmail;
use Illuminate\Support\Facades\Mail;

define('COUNT',4);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();



Route::get('fillable','CrudController@getCommande');

Route::get('/dashbord',function (){

    return'Not Adult';
    })->name('not.adult');


 // ajout des données dans BD

Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function (){

	 Route::group(['prefix' =>'commands' ], function(){
	 Route::get('create','CrudController@create');
	 Route::post('store','CrudController@store')->name('commands.store');

         Route::get('edit/{command_id}','CrudController@editCommand');
         Route::post('update/{command_id}','CrudController@updateCommand')->name('commands.update');
         Route::get('delete/{command_id}','CrudController@delete')->name('commands.delete');
         Route::get('all','CrudController@getAllCommands')->name('commands.all');
         Route::get('get-all-inactive-command','CrudController@getAllInactiveCommands');

    });
    Route::get('youtube','CrudController@getVideo')->middleware('auth');

    /*  ***********ajax using create into DB********** */
    Route::group(['prefix'=>'ajax-commands'],function (){
        route::get('create','CommandController@create');
        route::post('store','CommandController@store')->name('ajax.commands.store');
    });

    /*  ***********End ajax  * *********************** */
});



          ############### Begin Authentication ################



Route::group(['middleware'=>'CheckAge','namespace'=>'Auth'],function () {

    Route::get('adults', 'CustomAuthController@adulte')->name('adult');
});
                     ############### End Authentication ##################




                          ############## Middleware Guards ###################

Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')-> name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin') -> name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');

                        ##############  End Middleware Guards ###################




                        ############## Begin Relations  ###################

Route::get('has-one','Relation\RelationsController@hasOneRelation');
Route::get('has-reverse','Relation\RelationsController@hasOneRelationReverse');

Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');
Route::get('get-user-not-has-phone','Relation\RelationsController@getUserNotHasPhone');
Route::get('get-user-with-condition','Relation\RelationsController@getUserHasPhoneWithCondition');

                       ############### End Relations ##################


                       ##############  Begin One To many ##############


Route::get('hospital-has-may','Relation\RelationsController@getHospitalDoctors');

Route::get('hospitals','Relation\RelationsController@hospitals')->name('hospital.all');

Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')->name('hospital.doctors');
Route::get('hospitals/{hospital_id}','Relation\RelationsController@deleteHospital')->name('hospital.delete');

Route::get('hospitals_has_doctors','Relation\RelationsController@hospitalsHasdoctor');
Route::get('hospitals_has_doctors_male','Relation\RelationsController@hospitalsHasOnlyMaledoctor');
Route::get('hospitals_not_has_doctors','Relation\RelationsController@hospitalsNotHasDoctor');

Route::get('doctors-services','Relation\RelationsController@getDoctorServices');
Route::get('services-doctors','Relation\RelationsController@getServicesDoctor');
Route::get('doctor-serv/{doctor_id}','Relation\RelationsController@getdoctorServ')->name('doc.services');
Route::post('saveServices-to-doctor','Relation\RelationsController@saveServicesToDoctor')->name('save.services.doctors');


                        ############## End One To many  ###################


############################### has one Through ###################################

Route::get('has-one-through','Relation\RelationsController@getPatientDoctor');

############################## has many Through ####################################

Route::get('has-many-through','Relation\RelationsController@getCountryDoctor');

############################## End has may through ###############################


############################## Begin Accessors and Mutators ##########################

Route::get('accessors','Relation\RelationsController@getDoctors');

############################## End Accessors and Mutators ############################






