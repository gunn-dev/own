@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        Direct BayDin
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
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Nyih Nan</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Services</th>
                            <th>Marital Status</th>
                            <th>Baydin Sayar</th>
                            <th>Phone Number</th>
                            <th>About</th>
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
                                    {{ $lovebaydin->name }}
                                </td>
                                <td>
                                    {{ $lovebaydin->birth_date }}
                                </td>
                                <td>
                                    {{ $lovebaydin->nyih_nan }}
                                </td>
                                <td>{{$lovebaydin->gender}}</td>
                                <td>
                                    {{ $lovebaydin->address }}
                                </td>
                                <td>
                                    {{ $lovebaydin->services }}
                                </td>
                                <td>{{ $lovebaydin->marital_status }}</td>
                                <td>{{ $lovebaydin->baydin_sayar }}</td>
                                <td>
                                    {{ $lovebaydin->phone_number }}
                                </td>
                                <td>
                                    {{ $lovebaydin->about }}
                                </td>
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
                                    <form action="{{route('admin.directbaydin.content.deliver.index')}}" method="POST">
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

