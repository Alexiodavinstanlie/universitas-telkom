<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Dosen;

class DosenController extends Controller
{
    public function find(){
        return $this->responseSuccess(Dosen::find(request()->id));
    }
}
