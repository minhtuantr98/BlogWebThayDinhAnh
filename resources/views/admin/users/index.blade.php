@extends('layouts/backend')
{{-- 
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">User</li>
        </ol>
    </nav>
<div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{ "User" }}</h1>
</div>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Sorry !</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<div class="panel-body">
    <a href="/admin/user/create" class="badge badge-dark">Create User</a>
</div>
<form action="/admin/user" method="GET" role="search">
    <div class="input-group">
        <input type="text" class="form-control" name="name" placeholder="Search User"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="badge badge-dark">Search</span>
            </button>
        </span>
    </div>
</form>
<div>
    @if(count($users) == 0)
    <p style="color:red;font-size:20px">There is no user for you search !!!<p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                @foreach ($users as $value)
                <tr>
                    <th scope="row" style="padding-top: 16px;">{{ $value->id }}</th>
                    <td>@if($value->is_admin == 1)
                        <p style="color:red">Admin</p>
                        @else
                        <p style="color:green">User</p>
                        @endif
                    </td>
                    <td>
                        <form action="/admin/user/{{ $value->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div id="category">
                                <p>{{ $value->email }}</p>
                                <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?') "
                                    value="Delete">
                                <a class="btn btn-primary" href="/admin/user/{{ $value->id }}/edit"
                                    role="button">Edit</a>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div style="padding-left:300px"> {{ $users->links() }}</div>
            @endif
</div>
</div>
@endsection
--}}
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item " aria-current="page">User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="panel-heading">
                        <h1>{{ "User" }}</h1>
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Sorry !</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif
                    <div class="panel-body">
                        <a href="/admin/user/create" class="badge badge-dark"
                            style="width:80px;height:40px;font-size:23px">Create User</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="/admin/user" method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" placeholder="Search User"> <span
                            class="input-group-btn">
                            <button type="submit" style="height: 50px" class="btn btn-default">
                                Search
                            </button>
                        </span>
                    </div>
                </form>
                <div class="card-body">
                   
                            @if(count($users) == 0)
                            <p style="color:red;font-size:20px">There is no user for you search !!!<p>
                                    @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Name</th>
                                            </tr>
                                        </thead>
                                        @foreach ($users as $value)
                                        <tr>
                                            <th scope="row" style="padding-top: 16px;">{{ $value->id }}</th>
                                            <td>@if($value->is_admin == 1)
                                                <p style="color:red">Admin</p>
                                                @else
                                                <p style="color:green">User</p>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="/admin/user/{{ $value->id }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div id="category">
                                                        <p>{{ $value->email }}</p>
                                                        <input type="submit" class="btn btn-danger" style="float: right"
                                                            onclick="return confirm('Are you sure ?') " value="Delete">
                                                        <a class="btn btn-primary"
                                                            style="float: right;margin-right:10px"
                                                            href="/admin/user/{{ $value->id }}/edit"
                                                            role="button">Edit</a>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <div style="margin:30px; float:right"> {{ $users->links() }}</div>
                                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
