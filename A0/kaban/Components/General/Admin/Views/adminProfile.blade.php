@extends('layouts.admin-login-layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Form') }}</div>

                    <div class="card-body">
                        @if (session('success-status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success-status') }}
                            </div>
                        @endif
                        @if (session('danger-status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('danger-status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.profile.update') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') ?? $admin->name }}" required autocomplete="name"
                                           autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') ?? $admin->email}}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @if(auth()->user()->rank >= \Kaban\General\Enums\EAdminRank::superAdmin)
                                <div class="form-group row">
                                    <label for="admin_rank" class="col-md-4 col-form-label text-md-right">Admin
                                        Role</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="admin_rank" name="rank">
                                            {!! \Kaban\General\Enums\EAdminRank::optionizeValue(true,'admin.rank.',$admin->rank)!!}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="status" name="status">
                                            {!! \Kaban\General\Enums\EAdminStatus::optionizeValue(true,'admin.status.',$admin->status)!!}
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="target_admin_id" value="{{$admin->id}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
