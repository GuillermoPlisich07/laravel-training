<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;

class HelperController extends Controller
{
    public function helper_inicio(){
        $version = Helpers::getVersion();
        $saludo = Helpers::getNombre('Juan');
        return view('helper.home', compact('version', 'saludo'));
    }
}