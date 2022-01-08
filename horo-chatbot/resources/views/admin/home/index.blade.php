@extends('admin.layouts.master')

@section('content')
    <section class="content">
        <div class="container-fluid">

            {{--@yield('content')--}}
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <form action="{{ route('admin.search') }}" method="post">
                @csrf
                <div class="row clearfix">

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="horo_image">Start Date</label>
                        <div class="form-group">
                            <input type="date" name='start_date' id="horo_image" class="form-control"
                                   placeholder="Upload image" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="horo_image">End Date</label>
                        <div class="form-group">
                            <input type="date" name='end_date' id="horo_image" class="form-control"
                                   placeholder="Upload image" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label for="horo_image">&nbsp;</label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary  waves-effect">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">Subscribers</div>
                            <div class="number count-to" data-from="0" data-to="{{ $subsrcibers }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Revenue</div>
                            <div class="number count-to" data-from="0" data-to="{{ $revenue }}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <canvas id="bar_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form action="{{ route('admin.getProfile') }}" method="post" id="getUser">
                                @csrf
                                <div class="row clearfix">

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label for="id">Search User name and Profile</label>
                                        <div class="form-group">
                                            <input type="text" name='id' class="form-control"
                                                   placeholder="User Id here" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label for="horo_image">&nbsp;</label>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary  waves-effect">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function () {
            new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
        });

        function getChartJs(type) {
            var config = null;
            if (type === 'bar') {
                config = {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($names) ?>,
                        datasets: [{
                            label: "Revenue",
                            data: <?php echo json_encode($price) ?>,
                            backgroundColor: 'rgba(0, 188, 212, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: false
                    }
                }
            }
            return config;
        }
    </script>

    <script>

        $("#getUser").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                url: url,
                type: "POST",
                data: form.serialize(),
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function (data) {

                    Swal.fire({
                        title: data.name,
                        html:

                            '<a href="'+ data.profile+'">Cick Here To Download Profile</a> '
                           ,
                        imageUrl: data.profile,
                        imageWidth: 1000,
                        imageHeight: 300,
                        imageAlt: 'Custom image',
                    });
                    $(".getProfile").html('<div class="badge badge-success">' + data.name + '<br>( <a target="_blank" href="'+ data.profile +'"> ' + data.profile + '</a> )</div><br>');
                },
                error: function () {
                    alert(message);
                },
            })
        });


    </script>

@endsection