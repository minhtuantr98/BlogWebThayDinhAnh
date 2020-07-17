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
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/category">Category</a></li>
            <li class="breadcrumb-item ">Create</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="panel-heading">
                <h1>{{ "Create Category" }}</h1>
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
        
              @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div> 
              @endif
          <!-- /.card-header -->
          <div class="card-body">
            <form action="/admin/category" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                <label>Name</label>
                <input class="form-control" placeholder="Enter Name..." type="text" name="name" ><br>  
                <input class="btn btn-primary" type="submit" value="Create">
                </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
</div>
@endsection
