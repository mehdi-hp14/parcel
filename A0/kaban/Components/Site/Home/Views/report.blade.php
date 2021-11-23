@extends('layouts.report')
@section('early-style')
    <style>
        .badge-pill {
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <div class="container" id="appoo">
        <button id="export-csv" class="btn btn-warning"
                v-if="selectedCsv.length"
                @click="exportSelectedCsv"
                style="position: fixed;bottom: 10px;right: 10px"
        >export selected as csv
        </button>

        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12">
                <form method="get" action="{{ route('admin.report',$type) }}">
                    {{--                    @csrf--}}
                    @if(request('qid1'))
                        <input type="hidden" name="qid1" value="{{request('qid1')}}">
                    @endif

                    @if(request('qid2'))
                        <input type="hidden" name="qid2" value="{{request('qid2')}}">
                    @endif
                    {{--                    <div class="card-header">{{ __('quote number '.$quote->id) }}</div>--}}
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="status">Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="pending-switch"
                                               name="status[]"
                                               value="pending"
                                               @if(request('status') && in_array('pending',request('status'))) checked
                                               @endif
                                               @if($initialRequest) checked @endif
                                        >
                                        <label class="custom-control-label" for="pending-switch">Pending</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="hold-switch"
                                               name="status[]"
                                               value="hold"
                                               @if(request('status') && in_array('hold',request('status'))) checked
                                               @endif
                                               @if($initialRequest) checked @endif

                                        >
                                        <label class="custom-control-label" for="hold-switch">Hold</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active-status"
                                               name="status[]"
                                               value="active"
                                               @if(request('status') && in_array('active',request('status'))) checked
                                               @endif
                                               @if($initialRequest) checked @endif

                                        >
                                        <label class="custom-control-label" for="active-status">Active</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="cancelled-status"
                                               name="status[]" value="cancelled"
                                               @if(request('status') && in_array('cancelled',request('status'))) checked
                                               @endif
                                               @if($initialRequest) checked @endif
                                        >
                                        <label class="custom-control-label" for="cancelled-status">Cancelled</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="completed-status"
                                               name="status[]" value="completed"
                                               @if(request('status') && in_array('completed',request('status'))) checked
                                               @endif
                                               @if($initialRequest) checked @endif
                                        >
                                        <label class="custom-control-label" for="completed-status">Completed</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="from_weight">From Weight</label>
                                        <input type="text" class="form-control" name="from_weight" id="from_weight"
                                               value="{{request('from_weight')}}"
                                               aria-describedby="from_weight" placeholder="">
                                        {{--                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="to_weight">To Weight</label>
                                        <input type="text" class="form-control" name="to_weight" id="to_weight"
                                               value="{{request('to_weight')}}"
                                               aria-describedby="to_weight" placeholder="">
                                        {{--                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="from-country">From Country</label>
                                        <v-select id="search-users"
                                                  v-model="selectedFromCountries"
                                                  :options="countries"
                                                  multiple
                                        >
                                        </v-select>
                                        <select multiple name="from_countries[]" style="display: none">
                                            <option v-for="country in selectedFromCountries"
                                                    :value="country" selected>
                                                @{{country}}
                                            </option>
                                        </select>


                                        {{--                                        <select class="form-control" name="from_country" id="from-country">--}}
                                        {{--                                            <option value="">not affect</option>--}}
                                        {{--                                        @foreach(\Kaban\Models\Quote::countries() as $country)--}}
                                        {{--                                                <option value="{{$country}}"--}}
                                        {{--                                                        @if(request('from_country') && request('from_country')==$country) selected @endif--}}
                                        {{--                                                >{{$country}}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        </select>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="to-country">To Country</label>
                                        <v-select id="search-users"
                                                  v-model="selectedToCountries"
                                                  :options="countries"
                                                  multiple
                                        >
                                        </v-select>
                                        <select multiple name="to_countries[]" style="display: none">
                                            <option v-for="country in selectedToCountries" selected="selected"
                                                    :value="country">
                                                @{{country}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="search-users">Search Quote User</label>

                                        <v-select id="search-users"
                                                  :filterable="false"
                                                  label="fname"
                                                  v-model="selectedUser"
                                                  :reduce="option => option.uname"
                                                  :options="options"
                                                  @search="onSearch">
                                        </v-select>
                                        <input type="hidden" :value="selectedUser"
                                               name="search_user"
                                        >
                                    </div>
                                    <div class="form-group">

                                        <label for="search-users">Search Collection Locations</label>
{{--                                        :reduce="option => option.uname"--}}
{{--                                        label="fname"--}}

                                        <v-select id="search-users"
                                                  v-model="selectedCollectionLocations"
                                                  :options="collectionLocations"
                                                  multiple
                                        >
                                        </v-select>
                                        <select multiple name="collectionLocations[]" style="display: none">
                                            <option v-for="item in selectedCollectionLocations" selected="selected"
                                                    :value="item">
                                                @{{item}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="mutual-collocations"
                                           name="mutual-collocations"
                                           value="1"

                                    >
                                    <label class="custom-control-label" for="mutual-collocations">Show Mutual Collocations</label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary">submit</button>
                            @if(count($quotes))
                                <button id="export-csv" class="btn btn-primary">export csv</button>
                            @endif
                        </div>
                    </div>
                    <div class="card my-5">
                        <div class="card-header">
                            <h5>Quote Counts</h5>
                        </div>
                        <div class="card-body">

                            <div class="container">
                                {{--                                <p>The .table-bordered class adds borders on all sides of the table and the cells:</p>--}}
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Pending</th>
                                        <th>Hold</th>
                                        <th>Active</th>
                                        <th>Cancelled</th>
                                        <th>Completed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$quotes->where('status',\Kaban\General\Enums\EQuoteStatus::pending)->count() }}</td>
                                        <td>{{$quotes->where('status',\Kaban\General\Enums\EQuoteStatus::hold)->count() }}</td>
                                        <td>{{$quotes->where('status',\Kaban\General\Enums\EQuoteStatus::active)->count() }}</td>
                                        <td>{{$quotes->where('status',\Kaban\General\Enums\EQuoteStatus::cancelled)->count() }}</td>
                                        <td>{{$quotes->where('status',\Kaban\General\Enums\EQuoteStatus::completed)->count() }}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if(!empty(request('mutual-collocations')))
                    <div class="card my-5">
                        <div class="card-header">
                            <h5>Mutual Collocations</h5>
                        </div>
                        <div class="card-body">

                            <div class="container">
                                {{--                                <p>The .table-bordered class adds borders on all sides of the table and the cells:</p>--}}
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>From Collocation</th>
                                        <th>Names</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fromLocationGrouped as $key=>$val)
                                        <tr>
                                            <th>{{$key}}</th>
                                            <th>{{'user namesss'}}</th>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($quotes as $quote)
                        {{--                            {{dd($quote->urls->first())}}--}}
                        {{--                        @if($quote->id == 54 $quote->url && $url = $quote->url->first() && ($agent = $url->first()->agent))--}}
                        <div class="card  my-5">
                            <div
                                class="card-header" data-csv-key>
                                <span
                                    class="title">{{ __('quote number '.$quote->id).' - '.\Kaban\General\Enums\EQuoteStatus::farsi($quote->status) }}</span>
                                <span data-csv-value></span>
                            </div>

                            <div class="card-body">
                                {{--                                <input type="checkbox" v-model="cc">--}}
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" id="csv-mark-{{$quote->id}}"
                                           class="custom-control-input"
                                           name="csv-mark"
                                           :value="{{$quote->id}}"
                                           v-model="selectedCsv"
                                    >
                                    <label class="custom-control-label" for="csv-mark-{{$quote->id}}">Mark for csv group
                                        download</label>
                                </div>
                                <ul class="list-group">

                                    @if($quote->urls && ($url = $quote->urls->first()) && ($agent = $url->first()->agent))
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-csv-key>
                                            <span class="title">Agent ID</span>
                                            <span class="badge badge-primary badge-pill"
                                                  data-csv-value>{{$agent->id }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-csv-key>
                                            <span class="title">Agent Email</span>
                                            <span class="badge badge-primary badge-pill" contenteditable="true"
                                                  data-csv-value>{{$agent->email }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-csv-key>
                                            <span class="title">Agent Name</span>
                                            <span class="badge badge-primary badge-pill" contenteditable="true"
                                                  data-csv-value>{{$agent->fname }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-csv-key>
                                            <span class="title">Agent Company</span>
                                            <span class="badge badge-primary badge-pill"
                                                  data-csv-value>{{$agent->cname }}</span>
                                        </li>
                                    @else
                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                            data-csv-key>
                                            <span class="title">Agent is unset.</span>
                                            <span data-csv-value></span>
                                        </li>
                                    @endif
                                    <li class="list-group-item list-group-item-primary" data-csv-key>
                                        <span class="title">Sender (Collection) Information ( Also for HAWB)</span>
                                        <span data-csv-value></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Company Name</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->scompany??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Address</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->saddress??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Zip Code</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->szipcode??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Country</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->scountry??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Contact Person</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->scontactp??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Telephone</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->stelephone??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">E-mail</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{!empty($quote->shipInfo->semail)?$quote->shipInfo->semail:'---'}}</span>
                                    </li>
                                    <li class="list-group-item list-group-item-danger" data-csv-key>
                                        <span class="title">Receiver (Delivery) Information ( Also for HAWB)</span>
                                        <span data-csv-value></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Company Name</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->rcompany??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Address</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->raddress??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Zip Code</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->rzipcode??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Country</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->rcountry??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Contact Person</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->rcontactp??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">Telephone</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{$quote->shipInfo->rtelephone??'---'}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center"
                                        data-csv-key>
                                        <span class="title">E-mail</span>
                                        <span data-csv-value
                                              class="badge badge-primary badge-pill"
                                              contenteditable="true">{{!empty($quote->shipInfo->remail)?$quote->shipInfo->remail:'---'}}</span>
                                    </li>

                                </ul>

                            </div>
                        </div>
                        <span data-csv-key>
                            <span class="title"></span>
                            <span data-csv-value></span>
                        </span>
                    @endforeach
                </form>
                <div>
                    Please confirm that you have received this confirmation order.<br>
                    <br>Best Regards<br>
                    Fazel Zohrabpour<br>
                    <br>
                    <div style="font-size:80%;color:#0033cc;">
                        <img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;">
                        <br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>
                        Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('later-scripts')
    <script>
        var selectedUser = @json($selectedUser);
        var selectedFromCountries = @json(request('from_countries'));
        var selectedToCountries = @json(request('to_countries'));
        var selectedCollectionLocations = @json(request('collectionLocations'));
        {{--        var selectedFromCountries = {{request('from_countries') ? json_encode(request('from_countries')):'[]'}};--}}
        {{--        var selectedToCountries = {{request('to_countries') ? (request('to_countries')):'[]'}};--}}
        {{--var selectedToCountries = @json(request('from_countries')? explode(',',request('from_countries')):[]);--}}
        {{--var selectedToCountries = @json(request('to_countries')? explode(',',request('to_countries')):[]);--}}
        var countries = @json(\Kaban\Models\Quote::countries());
        var reportUserApi = '{{route('site.report.search-users')}}';
        var collectionLocations = @json($cachedCollectionLocationsQuotes->pluck('from_location')->unique()->values());
    </script>
    <script src="{{ asset('A0/public/resources/site/js/reports.js') }}"></script>
@endsection
