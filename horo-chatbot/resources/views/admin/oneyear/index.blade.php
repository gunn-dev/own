@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        One Year Bay Din
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
                            <th>Customer Name</th>
                            <th>Birth Time</th>
                            <th>Birth Date</th>
                            <th>Birth Place</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Nyih Nan</th>
                            <th>Career</th>
                            <th>About</th>
                            <th>Marital Status</th>
                            <th>Delivered</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($oneyears as $oneyear)
                            <tr>

                                <td>
                                    {{ $oneyear->created_at->toDateString() }}
                                </td>

                                <td>{{ getName($oneyear->user_id) }}</td>
                                <td>
                                    @if(isset($oneyear->name))
                                        {{ $oneyear->name }}
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                    {{ $oneyear->birth_time }}
                                </td>
                                <td>
                                    {{ $oneyear->birth_date }}
                                </td>
                                <td>{{$oneyear->birth_place}}</td>
                                <td>{{$oneyear->phone_number}}</td>
                                <td>{{$oneyear->address}}</td>
                                <td> {{ $oneyear->nyih_nan }} </td>
                                <td>{{ $oneyear->career }}</td>
                                <td>{{ $oneyear->about }}</td>
                                <td>@if($oneyear->marital_status == 1)
                                        <span class="label label-primary">yes</span>
                                    @endif
                                    @if($oneyear->marital_status == 0)
                                        <span class="label label-primary">no</span>
                                    @endif

                                </td>
                                <td>@if($oneyear->is_delivered == 1)
                                        <span class="label label-success">yes</span>
                                    @endif
                                    @if($oneyear->is_delivered == 0)
                                        <span class="label label-info">no</span>
                                    @endif

                                </td>
                                <td>@if($oneyear->status == 1)
                                        <span class="label label-success">success</span>
                                    @endif
                                    @if($oneyear->status == 2)
                                        <span class="label label-danger">failed</span>
                                    @endif
                                    @if($oneyear->status == 0)
                                        <span class="label label-warning">pending</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.oneyear.content.deliver.index')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $oneyear->user_id }}">
                                        <input type="hidden" name="id" value="{{ $oneyear->id }}">
                                        <button type="submit" class="btn btn-success">Send</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $oneyears->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

