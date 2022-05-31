<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Study
{
    private $name;
    private $age;

    private function get($name,$age)
    {
        $a=$this->name=$name.'work';
        $b=$this->age=$age+100;
        return [$a,$b];

    }
    public function nameage($name,$age)
    {
        $name=$name.'first';
        $age=$age+33;
        $answer=$this->get($name,$age);
        return $answer;
    }

}

class StudyController extends Controller
{

    public function show(Request $request)
    {
        dump($request);
        $oleg=new Study();

        return $oleg->nameage('oleg',1);
    }
}


