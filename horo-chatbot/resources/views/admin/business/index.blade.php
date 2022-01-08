@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        Business Naming
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
                            <th>Owner Name</th>
                            <th>Birth Date</th>
                            <th>Business Type</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Nyih Tha</th>
                            <th>Delivered</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($businesses as $business)
                            <tr>
                                <td>
                                    {{ $business->created_at->toDateString() }}
                                </td>
                                <td>{{ getName($business->user_id) }}</td>
                                <td>
                                    {{ $business->owner_name }}
                                </td>
                                <td>
                                    {{ $business->birth_date }}
                                </td>
                                <td>
                                    {{ $business->business_type }}
                                </td>
                                <td>{{$business->address}}</td>
                                <td>{{$business->phone_number}}</td>
                                <td> {{ $business->nyih_tha }} </td>
                                <td>@if($business->is_delivered == 1)
                                        <span class="label label-success">yes</span>
                                    @endif
                                    @if($business->is_delivered == 0)
                                        <span class="label label-info">no</span>
                                    @endif

                                </td>
                                <td>@if($business->status == 1)
                                        <span class="label label-success">success</span>
                                    @endif
                                    @if($business->status == 2)
                                        <span class="label label-danger">failed</span>
                                    @endif
                                    @if($business->status == 0)
                                        <span class="label label-warning">pending</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.business.content.deliver.index')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $business->user_id }}">
                                        <input type="hidden" name="id" value="{{ $business->id }}">
                                        <button type="submit" class="btn btn-success">Send</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $businesses->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

