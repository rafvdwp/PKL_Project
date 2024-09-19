<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inprojectController extends Controller
{
    public function index() {
        return view('inproject/lan');
    }
}
