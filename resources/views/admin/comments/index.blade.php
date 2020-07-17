@extends('layouts/backend')

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
                    <li class="breadcrumb-item " aria-current="page">Comment</li>
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
                        <h1>{{ "Comment" }}</h1>
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
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                   
                            @if(count($comments) == 0)
                            <p style="color:red;font-size:20px">There is no user for you search !!!<p>
                                    @else
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Content</th>
                                                <th scope="col">Name</th>
                                            </tr>
                                        </thead>
                                        @foreach ($comments as $value)
                                        <tr>
                                            <th scope="row" style="padding-top: 16px;">{{ $value->id }}</th>
                                            <td style="width:500px">
                                                {{ $value->content }}
                                            </td>
                                            <td>
                                                <form action="/admin/comment/{{ $value->id }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div id="category">
                                                        <p>{{ $value->name }}</p>
                                                        <input type="submit" class="btn btn-danger" style="float: right"
                                                            onclick="return confirm('Are you sure ?') " value="Delete">
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <div style="margin:30px; float:right"> {{ $comments->links() }}</div>
                                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
