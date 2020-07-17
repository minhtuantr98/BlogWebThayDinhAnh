@extends('layouts/backend')
@push('head')
    <script src="{{ asset('js/my.js')}}"></script>

@endpush
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item " ><a href="/admin/post">Post</a></li>
            <li class="breadcrumb-item active">Create</li>
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
                <h1>{{ "Create Post" }}</h1>
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
            <form action="/admin/post" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Enter title..." type="text" name="title"><br>
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                    <br>
                    <label>Content</label>
                    <textarea class="form-control" id="summary-ckeditor" name="content"></textarea>
    
                    <label>Category</label>
                    <select class="form-control" name="category">
                        @foreach ($categories as $value)
                        <option value="{{ $value->id }}">
                            {{ $value->name }}
                        </option>
                        @endforeach
                    </select><br>
                    <label for="">Time Publish</label>
                        <input name="published"  type='date' class="form-control" />
                    <br>
                    <label>File Image</label>
                    <input name="file" type="file">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Create">
                </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
</div>
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: "YYYY-MM-DD H:m:s",
            });
        });
    CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endsection
