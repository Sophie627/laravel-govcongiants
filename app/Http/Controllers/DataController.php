<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Data;

class DataController extends Controller
{
    public function index()
    {
        if(!isset($_GET['search']) || !isset($_GET['naics']) || !isset($_GET['fromDate']) || !isset($_GET['toDate'])) {
            $data = DB::table('wp_data')->paginate(10);

            return view('data.show', ['data' => $data]);
        } else {

            $terms = explode(',', $_GET['search']);
            $naicsData = explode(',', $_GET['naics']);
            array_pop($naicsData);
            if ($_GET['fromDate'] == '') $fromDate = '1900-01-01';
            else $fromDate = $_GET['fromDate'];
            if ($_GET['toDate'] == '') $toDate = '2099-01-01';
            else $toDate = $_GET['toDate'];


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
               ->where('response_deadline', '>', $fromDate . ' 00:00:00')
               ->where('response_deadline', '<', $toDate . ' 23:59:59')
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

            $data->withPath('?search=' . $_GET['search'] . '&naics=' . $_GET['naics'] . '&fromDate=' . $_GET['fromDate'] . '&toDate=' . $_GET['toDate']);

            if(!isset($_GET['page'])) {
                return view('data.result', ['data' => $data, 'search' => $_GET['search'], 'naics' => $_GET['naics'], 'fromDate' => $_GET['fromDate'], 'toDate' => $_GET['toDate']]);
            } else {
                return view('data.show', ['data' => $data, 'search' => $_GET['search'], 'naics' => $_GET['naics'], 'fromDate' => $_GET['fromDate'], 'toDate' => $_GET['toDate']]);
            }
        }
    }

}
