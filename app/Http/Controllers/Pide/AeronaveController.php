<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AeronaveController extends Controller
{
    public function index(Request $Request){

    	return view('sunarp.aeronave.consultar.index');
    }
}
