@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>No</th>
                    <th>Title</th>
                    <th>Body</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                            @php
                                Session::forget('error');
                            @endphp
                        </div>
                    @endif
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('article.edit', $article->id)}}" class="btn btn-sm btn-secondary ">Edit</a>
                            <form action="{{ route('article.destroy', $article->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                            </form>
                            <a href="{{ route('article.show', $article->id)}}" class="btn btn-sm btn-primary">View</a>
                        </div>
                    </td>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->body }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection