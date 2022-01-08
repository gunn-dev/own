@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <a href="{{ route('admin.content.create') }}" class="btn btn-success">Create Content</a>
                    <h2>
                        Contents
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Category</th>
                            <th>Content</th>
                            <th>Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contents as $content)

                            @php
                                $ss = \GuzzleHttp\json_decode($content->content);
                            @endphp

                            <tr>
                                <td>
                                    <a class="btn btn-success" href="{{route('admin.content.show', $content->id)}}">View</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('admin.content.edit', $content->id)}}">Edit</a>
                                </td>
                                <td>
                                    <form action="{{route('admin.content.destroy', $content->id)}}" method="POST">
                                        @csrf @method('DELETE')
                                        <input type="hidden" name="method" value="delete">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                                <td>{{$content->id}}</td>
                                <td></td>
                                <td>{{$content->category->title}}</td>
                                <td class="limited-text">  {{$ss[0]}}</td>
                                <td>{{$content->for_date}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $contents->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

