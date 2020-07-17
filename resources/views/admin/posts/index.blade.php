@extends('layouts/backend')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Post</li>
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
                <a href="/admin/post/create" class="badge badge-dark" style="width:80px;height:40px;font-size:23px">Create Post</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if(count($posts) == 0) 
            <p style="color:red;font-size:20px">There is no post for you search !!!<p>
            @else
            <table id="example2" class="table table-bordered table-hover">
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
                  <td style="width: 450px;">{{ $value->title }}</td>
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
                              <input type="submit" style="float: right;" class="btn btn-danger" onclick="return confirm('Are you sure ?') "
                                  value="Delete">
                               <a class="btn btn-primary"  style="float: right;margin-right:10px"   href="/admin/post/{{ $value->id }}/edit" role="button">Edit</a>
                          </div>
                      </form>
                  </td>
              </tr>
              @endforeach
            </table>
            <div style="float:right;margin:30px"> {{ $posts->links() }}</div>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
</div>
@endsection
