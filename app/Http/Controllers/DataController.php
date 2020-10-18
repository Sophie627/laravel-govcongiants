<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $data = DB::table('wp_data')->paginate(10);

        return view('data.show', ['data' => $data]);
    }
}