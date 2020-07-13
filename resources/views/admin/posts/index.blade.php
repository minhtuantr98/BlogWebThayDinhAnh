@extends('layouts/app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item " aria-current="page">Post</li>
    </ol>
</nav>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1>{{ "Post" }}</h1>
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
        <a href="/admin/post/create" class="badge badge-dark">Create Post</a>
    </div>
    <form action="/admin/post" method="GET" role="search">
        <div class="input-group">
            <input type="text" class="form-control" name="title"
                placeholder="Search Post"> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="badge badge-dark">Search</span>
                </button>
            </span>
        </div>
    </form>
    <div>
        @if(count($posts) == 0) 
                <p style="color:red;font-size:20px">There is no post for you search !!!<p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                </tr>
            </thead> 
            @foreach ($posts as $value)
            <tr>
                <th scope="row" style="padding-top: 16px;">@if($value->active == 0)
                    <p style="color:red">Waiting</p>
                @else
                    <p style="color:green">Active</p>
                @endif
                </th>
                <td>{{ $value->title }}</td>
                <td>@foreach ($categories as $cat)
                    @if($value->category_id == $cat->id) 
                    {{ $cat->name }}
                    @endif
                    @endforeach
                </td>
                <td>
                    <form action="/admin/post/{{ $value->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div id="category">
                            @foreach ($users as $u)
                    @if($value->user_id == $u->id) 
                    {{ $u->name }}
                    @endif
                    @endforeach
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?') "
                                value="Delete">
                            <a class="btn btn-primary" href="/admin/post/{{ $value->id }}/edit" role="button">Edit</a>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div style="padding-left:300px"> {{ $posts->links() }}</div>
        @endif
    </div>
</div>
@endsection
