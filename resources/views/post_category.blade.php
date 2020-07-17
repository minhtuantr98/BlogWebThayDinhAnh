@extends('layouts/frontend')
@section('content')
<h1 style="margin-bottom:30px">Category: {{ $category->name }}</h1>
<post-category :posts="{{ $posts }}"></post-category>
@endsection