<?php

namespace Kaban\Components\Site\Home\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Kaban\Components\Site\Home\Jobs\EmailToReportUsersJob;
use Kaban\Core\Controllers\SiteBaseController;
use Kaban\General\Enums\EQuoteStatus;
use Kaban\Models\Prenote;
use Kaban\Models\Quote;
use Kaban\Models\ShipInfo;
use Kaban\Models\User;
use PdfReport;

class ReportController extends SiteBaseController
{
    const cache_key = 'quotes-without-collectionLocations';

    public function __construct()
    {
//        $type1 = (new Type1());
//        dd($type1->index());
    }

    public function report($type, Request $request)
    {
        //dd($request->all());

        $baseQuery = Quote::select([DB::raw('*')
            , DB::raw('CAST(total_weight AS DECIMAL(10,2)) as total_weight_dec')
        ])->with(['shipInfo', 'user', 'urls.agent'])
            ->when(!empty($request->search_user), function ($q) {
                $q->where('uname', request('search_user'));
            })
            ->when($type == 1, function ($q) {
                $q->whereId(request('qid'));
            })
            ->when($type == 2, function ($q) {
                $q->whereBetween('id', [(int)$_GET['qid1'], (int)$_GET['qid2']]);
            })
            ->when($type == 3, function ($q) {
                $parms1 = explode("/", $_GET['date1']);
                $date1 = mktime(0, 0, 0, $parms1[1], $parms1[2], $parms1[0]);
                $parms2 = explode("/", $_GET['date2']);
                $date2 = mktime(23, 59, 59, $parms2[1], $parms2[2], $parms2[0]);

                $q->whereBetween('timestamp', [$date1, $date2]);
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
            ->when(!empty($request->from_countries), function ($q) {
                $q->whereIn('from', request('from_countries'));
            })
            ->when(!empty($request->to_countries), function ($q) {
                $q->whereIn('to', request('to_countries'));
            })
            ->when(!empty($request->collectionLocations), function ($q) {
                $q->whereIn('from_location', request('collectionLocations'));
            });


        $quotes = $baseQuery->get();
        $fromLocationGrouped = $quotes->groupBy('from_location')->filter(function ($val, $key) {
            return count($val) > 0;
        });


        if (empty($request->collectionLocations)) {
            Cache::forget(self::cache_key);
        }
        $cachedCollectionLocationsQuotes = Cache::rememberForever(self::cache_key, function () use ($quotes) {
            return $quotes; //its for Search Collection Locations input items
        });
        $selectedUser = null;

        if (!empty($request->search_user) && $quotes->first()) {
            $selectedUser = $quotes->first()->user->only('fullName', 'uname');
        }
        $initialRequest = empty(request('status'));

        $defaultPredefinedMessages = $this->getPreNotes();

        return view('SiteHome::report', compact('quotes', 'type', 'initialRequest', 'selectedUser',
            'cachedCollectionLocationsQuotes', 'fromLocationGrouped', 'defaultPredefinedMessages'));
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

    private function getPreNotes()
    {
        if (config('app.env') === 'production') {
            define("DB_HOST", "localhost");
            define("DB_NAME", "bookingp_qdb");
            define("DB_USER", "bookingp_qdusr");
            define("DB_PASS", ",f[~jvXI~WU)");
        } else {
            define("DB_HOST", "db");
            define("DB_NAME", "parcel");
            define("DB_USER", "root");
            define("DB_PASS", "secret");
        }
        $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die(mysql_error());
        mysqli_select_db($con, DB_NAME) or die(mysql_error());
        $q = "SELECT `id`,`title`,`message` FROM `prenotes` WHERE `type`=3 ORDER BY `id` ASC";
        $r = mysqli_query($con, $q);
        return mysqli_fetch_all($r, MYSQLI_ASSOC);
    }

    public function emailToReportUsers(Request $request)
    {
        $text = $request->mailtext;

        foreach ($request->payload as $payload) {
            $text = str_replace([
                '{CompanyName}', '{Address}', '{ZipCode}', '{ContactPerson}', '{Telephone}', '{Country}',
            ], [
                $payload['company_name'],
                $payload['address'],
                $payload['zipcode'],
                $payload['contact_person'],
                $payload['telephone'],
                $payload['country'],
            ], $text);

            EmailToReportUsersJob::dispatch($payload, $text, $request->mailSubject);
        }
        return response('ok');
    }

    public function saveShippingInfo(Request $request)
    {
        $payload = $request->payload;

        $shipInfo = ShipInfo::where('ref', $request->quoteId)->first();

        if (!$shipInfo) {
            return response()->json([
                'status' => 'error',
                'text' => 'there is no shipping information in database to update , for quote number ' . $request->quoteId . ' '
            ]);
        }

        foreach ($payload as $key => $requestItem) {
            if ($requestItem == '' || $requestItem === '---') {
                continue;
            }
            $key === 'senderAddress' ? $shipInfo->saddress = $requestItem : '';
            $key === 'senderZipcode' ? $shipInfo->szipcode = $requestItem : '';
            $key === 'senderContactPerson' ? $shipInfo->scontactp = $requestItem : '';
            $key === 'senderCompanyName' ? $shipInfo->scompany = $requestItem : '';
            $key === 'senderTelephone' ? $shipInfo->stelephone = $requestItem : '';
            $key === 'senderCountry' ? $shipInfo->scountry = $requestItem : '';
            $key === 'senderEmail' ? $shipInfo->semail = $requestItem : '';

            $key === 'receiverAddress' ? $shipInfo->raddress = $requestItem : '';
            $key === 'receiverContactPerson' ? $shipInfo->rcontactp = $requestItem : '';
            $key === 'receiverCompanyName' ? $shipInfo->rcompany = $requestItem : '';
            $key === 'receiverTelephone' ? $shipInfo->rtelephone = $requestItem : '';
            $key === 'receiverCountry' ? $shipInfo->rcountry = $requestItem : '';
            $key === 'receiverEmail' ? $shipInfo->remail = $requestItem : '';
        }
        $shipInfo->save();

        return response()->json([
            'status' => 'ok',
            'text' => 'shipping info for quote with id of ' . $request->quoteId . ' has updated',
        ]);
    }
}
