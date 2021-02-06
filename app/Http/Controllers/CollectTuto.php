<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\User;
use Illuminate\Http\Request;

class CollectTuto extends Controller
{
    //methode 1 collect
    public function index(){
       /* $numbers = [1 , 2 , 3];
        $col = collect($numbers);
        return $col->avg();*/

//methode 2 collect / combine

   /* $names  = collect(['name','age']);
    $res = $names-> combine(['Amine','28']);
    return $res;*/

  // methode 3 collecte count()

       /* $ages = collect([1,2,3,5,4,7,9,8]);
        return $ages->count();*/

   // methode 4 collecte countby()

      /*  $ages = collect([1,2,3,3,4,7,8,8]);
        return $ages->countBy();*/

// methode 5 collecte dublicates()

        $ages = collect([4,4,4,5]);
        return $ages->duplicates();
    }

    // collection each
    public function complex(){
         $users = User::get();

        $users-> each(function ($us){
           unset($us->age);
           return $us;
        });
        return $users;

    }

    //filter collection

    public function complexFilter(){

        $command = Command::get();
        $commands = collect($command);

        $resultFilter =$commands->filter(function ($value, $key){
            return $value['article_ar']=='en';

        });
        return array_values($resultFilter->all());
    }

    public function complexTransform(){

        $commands = Command::get();
        $commands -> collect($commands);

        $resultFilter =$commands->transform(function ($value, $key){

            $data=[];
            $data['nom-en']=$value['nom_en'];
            $data['age'] = 30;
            return $data;

        });
        return $resultFilter;

    }
}
