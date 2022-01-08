@extends('admin.layouts.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h2>
                        Phone Call Service
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
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
                            <th>Marital Status</th>
                            <th>Phone Number</th>
                            <th>Time</th>
                            <th>About</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($phone_call_services as $phone_call_service)
                            <tr>

                                <td>
                                    {{ $phone_call_service->created_at->toDateString() }}
                                </td>

                                <td>{{ getName($phone_call_service->user_id) }}</td>
                                <td>
                                    {{ $phone_call_service->name }}
                                </td>
                                <td>
                                    {{ $phone_call_service->birth_date }}
                                </td>
                                <td>
                                    {{ $phone_call_service->nyih_nan }}
                                </td>
                                <td>{{$phone_call_service->gender}}</td>
                                <td>
                                    {{ $phone_call_service->address }}
                                </td>
                                <td>{{ $phone_call_service->marital_status }}</td>

                                <td>
                                    {{ $phone_call_service->phone_number }}
                                </td>

                                <td>
                                    {{ $phone_call_service->call_time }}
                                </td>


                                <td>
                                    {{ $phone_call_service->about }}
                                </td>


                                <td>@if($phone_call_service->status == 1)
                                        <span class="label label-success">completed</span>
                                    @endif
                                    @if($phone_call_service->status == 2)
                                        <span class="label label-danger">failed</span>
                                    @endif
                                    @if($phone_call_service->status == 0)
                                        <span class="label label-warning">pending</span>
                                    @endif
                                </td>
                                <td> <button type="button" class="btn btn-primary" onclick="edit({{ $phone_call_service->id }})">
                                        Edit
                                    </button></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $phone_call_services->links() }}
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
                text: "Once edited, you will not be able to recover to previous condition for  this service!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url : "{{ url('/admin/phone_call/service/edit') }}" + '/' + id,
                            type : "POST",
                            data : {'_method' : 'PATCH'},
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            success : function(){
                                swal({
                                    title : 'Yess...',
                                    text : "Success! Service has been edited!",
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


