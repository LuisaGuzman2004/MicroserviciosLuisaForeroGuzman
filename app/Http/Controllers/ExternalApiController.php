<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nette\Utils\Html;
use Illuminate\Support\Facades\Http;

class ExternalApiController extends Controller
{
    //
    public function getEvents(){
        $response= Http::get('http://127.0.0.1:8001/api/index'); //Api de Camila

        return response()->json([
            'status' => 'success',
            'data' => $response->json()
        ], 200);
    }
}
