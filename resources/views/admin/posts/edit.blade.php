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
            <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
            <li class="breadcrumb-item " ><a href="/admin/post">Post</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
            <form action="/admin/post/{{ $post->id }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Enter title..." type="text" name="title" value="{{ $post->title }}"><br>
                    <label>Description</label>
                   <textarea class="form-control" name="description">{{$post->description }}</textarea>
                    <label>Content</label>
                    <textarea class="form-control" id="summary-ckeditor" name="content">{{ $post->content }}</textarea>
                        <label>Category</label>
                        <select class="form-control" name="category">
                                @foreach ($categories as $value)
                                <option value="{{ $value->id }}" 
                                        @if ($post->category_id == $value->id)
                                        {{ "selected" }}
                                    @endif>
                                    {{ $value->name }}
                                </option>
                                @endforeach
                        </select><br>
                        <label for="">Time Publish</label>
                    <input name="published" value="{{ $post->published_at }}"  type='date' class="form-control" />
                    <br>
                        <label>File Image</label>
                    <input name="file" type="file">
                    <input type="text" name="file_old" readonly value="{{$post->image}}">
                        <br>
                        <label for="">Active</label>
                        <select name="active" >
                            <option @if($post->active == 1) {{ "selected" }} @endif value="1">Active</option>
                            <option @if($post->active == 0) {{ "selected" }} @endif value="0">Inactive</option>
                        </select>
                        <br>
                        <label for="">Highlight</label>
                        <select name="is_highlight" >
                            <option @if($post->is_highlight == 1) {{ "selected" }} @endif value="1">Active</option>
                            <option @if($post->is_highlight == 0) {{ "selected" }} @endif value="0">Inactive</option>
                        </select>
                        <br>
                        <input class="btn btn-primary" type="submit" value="Edit">
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
