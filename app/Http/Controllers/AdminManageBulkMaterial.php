<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminManageBulkMaterial extends Controller
{
    public function index() {
        return view('admin.project.manageBulkMaterial');
    }
}