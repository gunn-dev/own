@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('article.update', $article->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{$article->title}}">
            </div>
            <div class="form-group">
                <label for="">Body</label>
                <input type="text" name="body" class="form-control" value="{{$article->body}}">
            </div>
            <input type="submit" value="Update" class="btn btn-sm btn-primary">
        </form>
    </div>
@endsection