@extends('layouts/frontend')
@section('content')
<post-detail  :post="{{ $post }}" :user="{{ $user }}" :comments="{{ $comments }}" :totalComment="{{ $totalComment }}"></post-detail>
@endsection