<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use function Symfony\Component\Translation\t;

class CategoryController extends Controller
{

    public function show()
    {
        $oleg=new User();
        $oleg->setAge(30);
        $oleg->addAge(10);

        $oleg->name='oleg';
        return [$oleg->age, $oleg->name];
    }


}
class User
{
    public $name;
    public $age;
    public function isAgeCorrect($age)
    {
        if ($age>=18 and $age<60)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function setAge($age)
    {
        if ($this->isAgeCorrect($age))
        {
            $this->age=$age;
        }
    }
    public function addAge($years)
    {
        $newAge=$this->age+$years;
        if($this->isAgeCorrect($newAge))
        {
          $this->age=$newAge;
        }
    }



}
