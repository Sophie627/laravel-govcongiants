<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Data;

class DataController extends Controller
{
    public function index()
    {
        if(!isset($_GET['search']) || !isset($_GET['naics'])) {
            $data = DB::table('wp_data')->paginate(10);

            return view('data.show', ['data' => $data]);
        } else {
            // print_r($_GET['search']);
            $terms = explode(',', $_GET['search']);
            $naicsData = explode(',', $_GET['naics']);
            array_pop($naicsData);


//            if(count($naicsData) > 0) {
//                $data = Data::query()
//                ->Where(function ($query) use ($naicsData) {
//                    foreach ($naicsData as $element) {
//                        $query->where('naics_code', '=', $element);
//                        print_r($element);
//                    }
//                });
//            } else {
//                $data = Data::query();
//            }

           $data = Data::query()
               ->Where(function ($query) use ($naicsData) {
                    foreach ($naicsData as $element) {
                        if ($element == $naicsData[0]) {
                            $query->where('naics_code', $element);
                        } else {
                            $query->orWhere('naics_code', $element);
                        }
                    }
                })
            ->Where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    // Loop over the terms and do a search for each.
                    $query->where('title', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%');
                }
            })
//            ->orWhere(function ($query) use ($terms) {
//                foreach ($terms as $term) {
//                    $query->where('description', 'like', '%' . $term . '%');
//                }
//            })
            ->paginate(10);

            $data->withPath('?search=' . $_GET['search'] . '&naics=' . $_GET['naics']);

            if(!isset($_GET['page'])) {
                return view('data.result', ['data' => $data, 'search' => $_GET['search'], 'naics' => $_GET['naics']]);
            } else {
                return view('data.show', ['data' => $data, 'search' => $_GET['search'], 'naics' => $_GET['naics']]);
            }
        }
    }

}
