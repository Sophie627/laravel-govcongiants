<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Data;
use \SimpleXLSXGen;

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

           $data = Data::query()
               ->Where(function ($query) use ($naicsData) {
                    foreach ($naicsData as $element) {
                        if ($element == $naicsData[0]) {
                            $query->where('naics_code', $element);
                        } else {
                            $query->orWhere('naics_code', $element);
                        }
                        if (strlen($element) == 5) $element = $element . '0';
                        $query->orWhere('naics_code', $element);
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
            ->paginate(10);

            $data->withPath('?search=' . $_GET['search'] . '&naics=' . $_GET['naics'] . '&fromDate=' . $_GET['fromDate'] . '&toDate=' . $_GET['toDate']);

            if(!isset($_GET['page'])) {
                return view('data.result', ['data' => $data, 'search' => $_GET['search'], 'naics' => $_GET['naics'], 'fromDate' => $_GET['fromDate'], 'toDate' => $_GET['toDate']]);
            } else {
                return view('data.show', ['data' => $data, 'search' => $_GET['search'], 'naics' => $_GET['naics'], 'fromDate' => $_GET['fromDate'], 'toDate' => $_GET['toDate']]);
            }
        }
    }

    public function downloadExcel() {
        $terms = explode(',', $_GET['search']);
        $naicsData = explode(',', $_GET['naics']);
        array_pop($naicsData);
        if ($_GET['fromDate'] == '') $fromDate = '1900-01-01';
        else $fromDate = $_GET['fromDate'];
        if ($_GET['toDate'] == '') $toDate = '2099-01-01';
        else $toDate = $_GET['toDate'];

        $data = Data::query()
            ->Where(function ($query) use ($naicsData) {
                foreach ($naicsData as $element) {
                    if ($element == $naicsData[0]) {
                        $query->where('naics_code', $element);
                    } else {
                        $query->orWhere('naics_code', $element);
                    }
                    if (strlen($element) == 5) $element = $element . '0';
                    $query->orWhere('naics_code', $element);
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
            })->get();

//        $dataExcel = [
//            ['ISBN', 'title', 'author', 'publisher', 'ctry' ],
//            [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
//            [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
//        ];
        $dataExcel = [
            ['ID', 'Notice ID', 'Title', 'Department', 'Sub_tier', 'Office', 'Type',  'Response Deadline', 'Naics Code', 'Link', 'Description'],
        ];
        foreach ($data as $element) {
            array_push($dataExcel, [
                $element->id, $element->notice_id, $element->title, $element->department, $element->sub_tier, $element->office, $element->type, $element->response_deadline, $element->naics_code, $element->link, $element->description
            ]);
        }
        $xlsx = SimpleXLSXGen::fromArray( $dataExcel );
        $filename =  rand(10000000, 99999999).'.xlsx';
        $xlsx->saveAs($filename);
//        $xlsx->saveAs('data.xlsx');

        return $filename;
    }
}
