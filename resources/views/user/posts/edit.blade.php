@extends('layouts/app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item "><a href="/admin/post">Post</a></li>
            <li class="breadcrumb-item ">Edit</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ "Edit Post" }}</h1></div>
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
        <div class="panel-body">
            <br>
            <form action="/user/post/{{ $post->id }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="Enter title..." type="text" name="title" value="{{ $post->title }}"><br>
                    <label>Description</label>
                <textarea class="form-control"  name="description">{{ $post->description }}</textarea>
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
                        <input class="btn btn-primary" type="submit" value="Edit">
                    </div>
            </form>
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
