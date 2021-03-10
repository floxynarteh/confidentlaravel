<?php

namespace App\Http\Controllers;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use App\ExampleObject;

class ExampleController extends Controller{

    public function __invoke(Request $request){


        // PackageObject::sameMethod();

        // $negotiator = new ExampleObject();
        $negotiator = resolve(ExampleObject::class);

        return response()

           ->noContent($negotiator->superLongMethod($request));

    }


    // public function __invoke(Request $request,  $packageObject){


    //     // PackageObject::sameMethod();

    //     $negotiator = resolve(ExampleObject::class);

    //     return response()

    //     ->noContent($negotiator->superLongMethod($request));

    // }

}
