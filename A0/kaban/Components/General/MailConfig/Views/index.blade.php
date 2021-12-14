@extends('layouts.admin-login-layout')
{{--@section('early-link-styles')--}}
{{--    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />--}}
{{--@endsection--}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
{{--                        <a href="{{route('admin.list')}}">{{ __('mail configs') }}</a>--}}
                        <a class="btn btn-success" href="{{route('mail-config.create')}}">{{ __('create new') }}</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cardd">
                                    {{--                                <div class="card-body">--}}
                                    {{--                                    <h5 class="card-title text-uppercase mb-0">Manage Users</h5>--}}
                                    {{--                                </div>--}}
                                    <div class="table-responsive">
                                        <form action="{{route('admin.list')}}" method="post">
                                            @csrf
                                            <table class="table no-wrap user-table mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="border-0 text-uppercase font-medium pl-1">#</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">DRIVER</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">HOST</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">PORT</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">USERNAME</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">PASSWORD</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">ENCRYPTION</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">FROM ADDRESS</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">NAME</th>
                                                    <th scope="col" class="border-0 text-uppercase font-medium">actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($mailConfigs as $item)
                                                    <tr>
                                                        <td class="pl-1">{{$item->id}}</td>
                                                        <td>
                                                            <h5>{{$item->driver}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->host}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->port}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->username}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->password}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->encryption}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->from_address}}</h5>
                                                        </td>
                                                        <td>
                                                            <h5>{{$item->to_address}}</h5>
                                                        </td>
                                                        <td>
                                                            <a onclick="return confirm('are you sure you want to delete this config?')"
                                                               href="{{route('mail-config.delete',$item->id)}}"
                                                               class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </a>
                                                            <a
                                                                href="{{route('mail-config.edit',$item->id)}}"
                                                                type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </a>
                                                            <a
                                                                href="{{route('mail-config.pickAsActive',$item->id)}}"
                                                                type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2">
                                                                <i class="fa {{$item->active ? 'fa-check':'fa-minus'}}"></i> </a>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                {!! $mailConfigs->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /*.card {*/
        /*    position: relative;*/
        /*    display: flex;*/
        /*    flex-direction: column;*/
        /*    min-width: 0;*/
        /*    word-wrap: break-word;*/
        /*    background-color: #fff;*/
        /*    background-clip: border-box;*/
        /*    border: 0 solid transparent;*/
        /*    border-radius: 0;*/
        /*}*/
        .btn-circle.btn-lg, .btn-group-lg>.btn-circle.btn {
            width: 50px;
            height: 50px;
            padding: 14px 15px;
            font-size: 18px;
            line-height: 23px;
        }
        .text-muted {
            color: #8898aa!important;
        }
        [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
            cursor: pointer;
        }
        .btn-circle {
            border-radius: 100%;
            width: 40px;
            height: 40px;
            padding: 10px;
        }
        .user-table tbody tr .category-select {
            max-width: 150px;
            border-radius: 20px;
        }

    </style>
@endsection
