@extends('layouts.app')
@section('early-link-styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users List') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cardd">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap user-table mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                            <th scope="col" class="border-0 text-uppercase font-medium">User Name</th>
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Occupation</th>--}}
                                            <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Added</th>--}}
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Category</th>--}}
{{--                                            <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="pl-4">6</td>
                                            <td>
                                                <h5 class="font-medium mb-0">{{$user->user_rame}} {{$user->lname}}</h5>
{{--                                                <span class="text-muted">{{\Illuminate\Support\Str::limit($user->address)}}</span>--}}
                                            </td>
                                            <td>
                                                <span class="text-muted">Visual Designer</span><br>
                                                <span class="text-muted">Past : teacher</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{$user->email}}</span><br>
                                                <span class="text-muted">{{$user->phone}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{$user->phone}}</span><br>
                                                <span class="text-muted">10: 55 AM</span>
                                            </td>
                                            <td>
                                                <select class="form-control category-select" id="exampleFormControlSelect1">
                                                    <option>Modulator</option>
                                                    <option>Admin</option>
                                                    <option>User</option>
                                                    <option>Subscriber</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </button>
                                                <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! $users->links() !!}
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
