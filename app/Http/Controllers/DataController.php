<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $data = DB::select('select * from wp_data', [1]);
        
        return view('data.show', ['data' => $data]);
    }
}