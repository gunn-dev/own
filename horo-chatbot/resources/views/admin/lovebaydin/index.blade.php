@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        Love Bay Din
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Facebook Name</th>
                            <th>G Name</th>
                            <th>G Birth Day</th>
                            <th>G Birth Date</th>
                            <th>G Address</th>
                            <th>B Name</th>
                            <th>B Birth Day</th>
                            <th>B Birth Date</th>
                            <th>B Address</th>
                            <th>Phone Number</th>
                            <th>Delivered</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lovebaydins as $lovebaydin)
                            <tr>

                                <td>
                                    {{ $lovebaydin->created_at->toDateString() }}
                                </td>

                                <td>{{ getName($lovebaydin->user_id) }}</td>
                                <td>
                                   {{ $lovebaydin->g_name }}
                                </td>
                                <td>
                                    {{ $lovebaydin->g_birth_day }}
                                </td>
                                <td>
                                    {{ $lovebaydin->g_birth_date }}
                                </td>
                                <td>{{$lovebaydin->g_address}}</td>
                                <td>
                                    {{ $lovebaydin->b_name }}
                                </td>
                                <td>
                                    {{ $lovebaydin->b_birth_day }}
                                </td>
                                <td>
                                    {{ $lovebaydin->b_birth_date }}
                                </td>
                                <td>{{$lovebaydin->b_address}}</td>
                                <td>{{$lovebaydin->phone_number}}</td>

                                <td>@if($lovebaydin->is_delivered == 1)
                                        <span class="label label-success">yes</span>
                                    @endif
                                    @if($lovebaydin->is_delivered == 0)
                                        <span class="label label-info">no</span>
                                    @endif

                                </td>
                                <td>@if($lovebaydin->status == 1)
                                        <span class="label label-success">success</span>
                                    @endif
                                    @if($lovebaydin->status == 2)
                                        <span class="label label-danger">failed</span>
                                    @endif
                                    @if($lovebaydin->status == 0)
                                        <span class="label label-warning">pending</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.lovebaydin.content.deliver.index')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $lovebaydin->user_id }}">
                                        <input type="hidden" name="id" value="{{ $lovebaydin->id }}">
                                        <button type="submit" class="btn btn-success">Send</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $lovebaydins->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

