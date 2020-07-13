@extends('layouts/app')
@push('head')
    <script src="{{ asset('js/my.js')}}"></script>

@endpush
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item "><a href="/user/post">Post</a></li>
        <li class="breadcrumb-item ">Create</li>
    </ol>
</nav>
<div class="panel panel-default">
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
    <div class="panel-body">
        <br>
        <form action="/user/post" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Title</label>
                <input class="form-control" placeholder="Enter title..." type="text" name="title"><br>
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
                <div class='input-group date' id='datetimepicker1'>
                    <input name="published"  type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                </div><br>
                <label>File Image</label>
                <input name="file" type="file">
                <br>
                <input class="btn btn-primary" type="submit" value="Create">
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
