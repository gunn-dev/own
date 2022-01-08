@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        Manual Payment
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
                           <th>Price</th>
                            <th>Payment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($manualpayments as $child)
                            <tr>
                                <td>{{ $child->created_at->toDateString() }}</td>

                                <td>{{ getName($child->user_id) }}</td>

                                <td>
                                    {{ $child->price }}
                                </td>
                                <td>
                                    {{ $child->payment_method }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $manualpayments->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

