<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\CommandRequest;
use App\Models\Command;
use App\Models\Video;
use App\Scopes\CommandScope;
use App\Traits\CommandTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use CommandTrait;
    public function __construct()
    {

    }


    public function create(){
        return view('commands.create');
    }

    public function store(CommandRequest $request){

        //validate data before insert to data base

        //$messages = $this-> getMessages();
       // $rules = $this-> getRules();

       // $validator = Validator::make($request->all(),$rules,$messages);

           // if ($validator->fails()){
             //   return redirect()->back()->withErrors($validator)->withInput($request->all());

          //  }

        //Insert photo in folder

        $file_name = $this ->saveImage($request->photo,'images/commands');


        //Insert data to DB

        Command::create([
            'photo'=>$file_name,
            'nom_ar'=> $request->nom_ar,
            'nom_en'=> $request->nom_en,
            'prix'=> $request->prix,
            'article_ar'=> $request->article_ar,
            'article_en'=> $request->article_en,
        ]);
          return redirect()->back()->with(['success'=>__('messages.Your data has been saved successfully Thank you!')]);


    }



   /* protected function getMessages(){

        return $messages =[
            'nom.required'=>__('messages.commands nom required'),
            'nom.unique'=>__('messages.commands nom most be unique'),
            'prix.required'=>'Le prix est Obligatoire.',
            'prix.numeric'=>'Le prix est de type entier.',
            'article.required'=>'L\'article est Obligatoire.',
        ];
    }
    protected function getRules(){

        return $rules = [
            'nom' => 'required|max:50|unique:commands,nom',
            'prix' => 'required|numeric',
            'article' => 'required',
        ];
    }*/

    public function getAllCommands(){
       /* $commands=Command::select(
            'id',
            'nom_'.LaravelLocalization::getCurrentLocale().' as nom',
            'prix',
            'article_'.LaravelLocalization::getCurrentLocale().' as article')->get();*/

##################### paginate result ######################

        $commands=Command::select(
            'id',
            'nom_'.LaravelLocalization::getCurrentLocale().' as nom',
            'prix',
            'photo',
            'article_'.LaravelLocalization::getCurrentLocale().' as article')->paginate(COUNT);

        //return view('commands.all',compact('commands'));
        return view('commands.paginations',compact('commands'));

    }

    public function editCommand($command_id){

            $command = Command::find($command_id);

                if (!$command)
                return redirect()->back();

           $command =  Command::select('id','nom_ar','nom_en','prix','article_ar','article_en')->find($command_id);
            return view('commands.edit',compact('command'));

    }

    public function delete($command_id){

       $command =  Command::find($command_id); // Command::where('id','$command_id')->first();
        if (!$command)

            return redirect() -> back()->with(['error'=>__('messages.command not exists ')]);

        $command->delete();

        return redirect()->route('commands.all')->with(['success'=>__('messages.command deleted successfully ')]);

}


    public function updateCommand(CommandRequest $request,$command_id){

        // 1 Validation

        // 2 Check if Command exist

        $command =  Command::find($command_id);
        if (!$command)
            return redirect()->back();

        //Update data

        $command-> update($request->all());
        return  redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

    }
    public function getVideo(){

        $video = Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video',$video);

    }

    public function getAllInactiveCommands(){
        // where whereNull whereNotNull whereIn

        //local scope
        //return  $inactiveCommands = Command::inactive()->get(); // all inactive commands 'status 0'

        //Global scope
       // return Command::get();   // all in active commands 'status 0'

        // How to remove global scope
        return $command = Command::withoutGlobalScope(CommandScope::class)->get(); // all commands


    }

}
