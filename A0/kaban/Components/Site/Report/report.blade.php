@extends('layouts.agent-login-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please login to continue') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('agentLoginAttempt') }}">
                        @csrf


                    </form>
                </div>
                <div>
                    Please confirm that you have received this confirmation order.<br>
                    <br>Best Regards<br>
                    Fazel Zohrabpour<br>
                    <br>
                    <div style="font-size:80%;color:#0033cc;">
                        <img src="https://bookingparcel.com/logo.gif" style="width:215px;height:50px;">
                        <br>Europost Express (UK) Ltd.<br>4 Corringham Road,<br>
                        Wembley - Middlesex<br>HA9 9QA- London , UK<br>Tel : +44(0) 7886105417<br>
                    </div>;
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
