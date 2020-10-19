<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class SearchController extends Controller
{
    public function index()
    {
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

        return view('data.result', ['data' => $data, 'search' => $_GET['search']]);
    }
}
