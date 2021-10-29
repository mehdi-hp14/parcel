<?php


namespace Kaban\Components\Site\Home\Controllers;


use App\Mail\Contact;
use Illuminate\Http\Request;
use Kaban\Components\Site\Home\Controllers\Report\Type1;
use Kaban\Components\Site\Home\Controllers\Report\Type2;
use Kaban\Components\Site\Home\Controllers\Report\Type3;
use Kaban\Core\Controllers\SiteBaseController;
use PdfReport;

class ReportController extends SiteBaseController {
    public function __construct()
    {
//        $type1 = (new Type1());
//        dd($type1->index());
    }
    public function report($type) {
        switch ($type){
            case 1;
               $output = (new Type1())->index();
            break;

            case 2;
//            dd($_GET);
                $output = (new Type2())->index();
                break;

            case 3;
                $output = (new Type3())->index();
                break;
        }
        return view( 'SiteHome::report' );
    }

    public function report0(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
        dd($request->all());

        $title = 'Registered User Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Registered on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        $queryBuilder = User::select(['name', 'balance', 'registered_at']) // Do some querying..
        ->whereBetween('registered_at', [$fromDate, $toDate])
            ->orderBy($sortBy);


        $columns = [ // Set Column to be displayed
            'Name' => 'name',
            'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Total Balance' => 'balance',
            'Status' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function($result) {
                    return $result->registered_at->format('d M Y');
                },
                'class' => 'left'
            ])
            ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
                'class' => 'right bold'
            ])
            ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])
            ->limit(20) // Limit record to be showed
            ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
}
