<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Data;

class DataController extends Controller
{
    public function index()
    {
        if(!isset($_GET['search'])) {
            $data = DB::table('wp_data')->paginate(10);

            return view('data.show', ['data' => $data]);
        } else {
            // print_r($_GET['search']);
            $terms = explode(',', $_GET['search']);
        
            $data = Data::query()
            ->Where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    // Loop over the terms and do a search for each.
                    $query->where('title', 'like', '%' . $term . '%');
                }
            })
            ->orWhere(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where('description', 'like', '%' . $term . '%');
                }
            })
            ->paginate(10);

            $data->withPath('?search=' . $_GET['search']);

            if(!isset($_GET['page'])) {
                return view('data.result', ['data' => $data, 'search' => $_GET['search']]);
            } else {
                return view('data.show', ['data' => $data, 'search' => $_GET['search']]);
            }
        }
    }
    
}