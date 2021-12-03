@extends('layouts.admin-login-layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create a new ') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('mail-config.update',$item->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('driver') }}</label>

                                <div class="col-md-6">
                                    <input id="driver" type="text" class="form-control @error('driver') is-invalid @enderror" name="driver" value="{{ $item['driver'] }}" required autocomplete="driver" autofocus>

                                    @error('driver')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' host') }}</label>

                                <div class="col-md-6">
                                    <input id="host" type="text" class="form-control @error('host') is-invalid @enderror" name="host" value="{{ $item['host'] }}" required autocomplete="host">

                                    @error('host')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' port') }}</label>

                                <div class="col-md-6">
                                    <input id="port" type="text" class="form-control @error('port') is-invalid @enderror" name="port" value="{{ $item['port'] }}" required autocomplete="port">

                                    @error('port')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $item['username'] }}" required autocomplete="username">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $item['password'] }}" required autocomplete="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' encryption') }}</label>

                                <div class="col-md-6">
                                    <input id="encryption" type="text" class="form-control @error('encryption') is-invalid @enderror" name="encryption" value="{{ $item['encryption'] }}" required autocomplete="encryption">

                                    @error('encryption')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' from_address') }}</label>

                                <div class="col-md-6">
                                    <input id="from_address" type="text" class="form-control @error('from_address') is-invalid @enderror" name="from_address" value="{{ $item['from_address'] }}" required autocomplete="from_address">

                                    @error('from_address')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="driver" class="col-md-4 col-form-label text-md-right">{{ __(' to_address') }}</label>

                                <div class="col-md-6">
                                    <input id="to_address" type="text" class="form-control @error('to_address') is-invalid @enderror" name="to_address" value="{{ $item['to_address'] }}" required autocomplete="to_address">

                                    @error('to_address')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('update mail config') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
