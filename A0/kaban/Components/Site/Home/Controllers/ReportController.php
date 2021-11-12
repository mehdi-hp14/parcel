<?php


namespace Kaban\Components\Site\Home\Controllers;


use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kaban\Components\Site\Home\Controllers\Report\Type1;
use Kaban\Components\Site\Home\Controllers\Report\Type2;
use Kaban\Components\Site\Home\Controllers\Report\Type3;
use Kaban\Core\Controllers\SiteBaseController;
use Kaban\General\Enums\EQuoteStatus;
use Kaban\Models\Quote;
use Kaban\Models\User;
use PdfReport;

class ReportController extends SiteBaseController
{
    public function __construct()
    {
//        $type1 = (new Type1());
//        dd($type1->index());
    }

    public function report($type, Request $request)
    {

        $quotes = Quote::select([DB::raw('*')
            , DB::raw('CAST(total_weight AS DECIMAL(10,2)) as total_weight_dec')
        ])->with(['shipInfo', 'user', 'urls.agent'])
            ->when($request->has('search_user'), function ($q) {
                $q->where('uname', request('search_user'));
            })
            ->when($type == 1, function ($q) {
                $q->whereId(request('qid'));
            })
            ->when($type == 2, function ($q) {
                $q->whereBetween('id', [(int)$_GET['qid1'], (int)$_GET['qid2']]);
            })
//             ->when(request()->has('status'),function ($q){
            ->where(function ($q) {

                $values = collect(request('status'))->map(function ($status) {
                    return EQuoteStatus::findValue($status);
                });
                if (!empty(request('status'))) {
                    $q->whereIn('status', $values);
                }
            })
            ->when(!empty(request('from_weight')), function ($q) {
                $q->whereRaw('CAST(total_weight AS DECIMAL(10,2)) >= ' . floatval(request('from_weight')));
            })
            ->when(!empty(request('from_weight')), function ($q) {
                $q->whereRaw('CAST(total_weight AS DECIMAL(10,2)) <= ' . floatval(request('to_weight')));
            })
            ->when(!empty($request->from_country), function ($q) {
                $q->where('from', request('from_country'));
            })
            ->when(!empty($request->to_country), function ($q) {
                $q->where('to', request('to_country'));
            })
            ->get();
//         dd($quotes);
        $selectedUser=null;
        if (!empty($request->search_user) && $quotes->first()) {
            $selectedUser = $quotes->first()->user->only('fullName', 'uname');
        }
        $initialRequest = empty(\request('status'));
        return view('SiteHome::report', compact('quotes', 'type', 'initialRequest', 'selectedUser'));

        switch ($type) {
            case 1;
                $quotes = (new Type1())->index();
                break;

            case 2;
//            dd($_GET);
                $quotes = (new Type2())->index();
                break;

            case 3;
                $quotes = (new Type3())->index();
                break;
        }

        return view('SiteHome::report', compact('quotes'));
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
            'Status' => function ($result) { // You can do if statement or any action do you want inside this closure
                return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Registered At', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function ($result) {
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

    private function countries()
    {
        return [
            'Test Country',
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Antigua',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina',
            'Burundi',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Cape Verde',
            'Central African Rep',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Comoros',
            'Congo',
            'Congo',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'East Timor',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Grenada',
            'Guatemala',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hong Kong',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland (Republic)',
            'Israel',
            'Italy',
            'Ivory Coast',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'Korea North',
            'Korea South',
            'Kosovo',
            'Kuwait',
            'Kyrgyzstan',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Macedonia',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Micronesia',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar (Burma)',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russian Federation',
            'Rwanda',
            'St Kitts & Nevis',
            'St Lucia',
            'Saint Vincent',
            'Samoa',
            'San Marino',
            'Sao Tome Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Swaziland',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Tonga',
            'Trinidad & Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Vatican City',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe'
        ];
    }

    public function searchUser(Request $request)
    {
        return User::where(function ($q) use ($request) {
//            $q->orWhere('lname','like',"%$request->q%");
            $q->where(DB::raw('CONCAT(fname," ",lname)'), 'like', "%$request->q%");
        })->limit(10)->get()->map(function ($item) {
//            ->only('fname','lname','id')
            return
                [
                    'fname' => $item->fname . ' ' . $item->lname,
                    'uname' => $item->uname,
                ];
        });
    }
}
