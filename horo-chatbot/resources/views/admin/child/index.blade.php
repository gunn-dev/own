@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        Child Naming
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
                            <th>Birth Time</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Birth Place</th>
                            <th>Nyih Nan</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Delivered</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($children as $child)
                            <tr>
                                <td>{{ $child->created_at->toDateString() }}</td>

                                <td>{{ getName($child->user_id) }}</td>

                                <td>
                                    {{ $child->birth_time }}
                                </td>
                                <td>
                                    {{ $child->father_name }}
                                </td>
                                <td>{{$child->mother_name}}</td>
                                <td>@if($child->gender == 1)
                                        <span class="label label-success">female</span>
                                    @else
                                        <span class="label label-primary">male</span>
                                    @endif

                                </td>
                                <td>
                                    {{ $child->birth_date }}
                                </td>
                                <td>{{$child->birth_place}}</td>
                                <td> {{ $child->nyih_nan }} </td>
                                <td>{{  $child->phone_number }}</td>
                                <td>{{  $child->address }}</td>
                                <td>@if($child->is_delivered == 1)
                                        <span class="label label-success">yes</span>
                                    @endif
                                    @if($child->is_delivered == 0)
                                        <span class="label label-info">no</span>
                                    @endif

                                </td>
                                <td>@if($child->status == 1)
                                        <span class="label label-success">success</span>
                                    @endif
                                    @if($child->status == 2)
                                        <span class="label label-danger">failed</span>
                                    @endif
                                    @if($child->status == 0)
                                        <span class="label label-warning">pending</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('admin.child.content.deliver.index')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $child->user_id }}">
                                        <input type="hidden" name="id" value="{{ $child->id }}">
                                        <button type="submit" class="btn btn-success">Send</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $children->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

