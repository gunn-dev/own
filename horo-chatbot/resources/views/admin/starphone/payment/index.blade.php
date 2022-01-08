@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        1875 Star Phone Payment
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Phone Number</th>
                            <th>Type</th>
                            <th>Pay With</th>
                            <th>Payment Status</th>
                            <th> Status </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>

                                <td>
                                    {{ $payment->created_at->toDateTimeString() }}
                                </td>
                                <td>{{ $payment->price }}</td>
                                <td>{{ $payment->phone }}</td>
                                <td> {{ $payment->type }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td> Success </td>
                                <td>
                                    @if($payment->send == '0')
                                        <span class="badge badge-info btn-warning">Pending</span>
                                        @elseif($payment->send == '1')
                                        <span class="badge badge-info btn-success">Completed</span>
                                        @endif
                                </td>
                                <td> <button type="button" class="btn btn-primary" onclick="edit({{ $payment->id }})">
                                        Edit
                                    </button></td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </section>
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function edit(id){
            swal({
                title: "Are you sure?",
                text: "Once edited, you will not be able to recover to previous condition for  this payment!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url : "{{ url('star_phone/payment/edit') }}" + '/' + id,
                            type : "POST",
                            data : {'_method' : 'PATCH'},
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            success : function(){
                                swal({
                                    title : 'Yess...',
                                    text : "Success! Payment has been edited!",
                                    icon : "success",
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error : function(){
                                swal({
                                    title : 'Opps...',
                                    text : 'Something wrong!',
                                    icon : 'error',
                                    timer : '1500'
                                });
                            },
                        })
                    } else {
                        swal("Cancel Editing!");
                    }
                });
        }

        $(document).ready(function () {
            $('#table').DataTable();
            @if(session()->has('flash_message'))
            md.showNotification('top', 'right', "{{ session()->get('flash_message') }}");
            @endif
        });
    </script>
    @endsection
@endsection


