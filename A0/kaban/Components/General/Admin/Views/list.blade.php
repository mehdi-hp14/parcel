@extends('layouts.admin-login-layout')
{{--@section('early-link-styles')--}}
{{--    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />--}}
{{--@endsection--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{route('admin.list')}}">{{ __('Users List') }}</a></div>

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
                                            <th scope="col" class="border-0 text-uppercase font-medium">name</th>
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Occupation</th>--}}
                                            <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">role</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">status</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">actions</th>
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Added</th>--}}
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Category</th>--}}
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td class="pl-1">{{$admin->id}}</td>
                                            <td>
                                                <h5 class="font-medium mb-0">{{$admin->name}}</h5>
{{--                                                <span class="text-muted">{{\Illuminate\Support\Str::limit($admin->address)}}</span>--}}
                                            </td>
                                            <td>
                                                <h5>{{$admin->email}}</h5>
                                            </td>
                                            <td>
                                                <h5>{{$admin->rank_en}}</h5>
                                            </td>
                                            <td>
                                                <h5>{{$admin->status_en}}</h5>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('you are about to removing {{$admin->email}}, are you sure?')"
                                                   href="{{route('admin.delete',$admin->id)}}"
                                                   class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </a>
                                                <a
                                                    href="{{route('admin.profile.see',$admin->id)}}"
                                                    type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </a>
                                            </td>
                                        </tr>

                                        @endforeach
{{--                                        <tr>--}}
{{--                                            <td class="pl-1">--}}
{{--                                                <input name="id" class="form-control form-control" type="search" placeholder="search id...">--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <input name="name" class="form-control form-control" type="search" placeholder="search name...">--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <input name="email" class="form-control form-control" type="search" placeholder="search email...">--}}
{{--                                            </td>--}}
{{--                                            <td></td>--}}
{{--                                            <td>--}}
{{--                                                <button type="submit" name="search" value="on" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2">search</button>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
                                        </tbody>
                                    </table>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            {!! $admins->links('pagination::bootstrap-4') !!}
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
