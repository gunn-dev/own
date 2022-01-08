@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-primary" href="{{route('admin.content.edit', $content->id)}}">Edit</a>
                    <br><br>
                    <table class="table">
                        <tr>
                            <th>Photo</th>
                            <td>:</td>
                            <td><img src="{{asset('storage/'.$content->image)}}" alt="" style="width: 300px;">
                            </td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>:</td>
                            <td>{{$content->category->title}}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td>{{$content->for_date}}</td>
                        </tr>
                        <tr>
                            <th>Content</th>
                            <td>:</td>
                            <td>{{$content->content}}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>:</td>
                            <td>{{$content->created_at}}</td>
                        </tr>  <tr>
                            <th>Updated At</th>
                            <td>:</td>
                            <td>{{$content->updated_at}}</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection
