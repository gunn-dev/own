@extends('admin.layouts.master')
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Create Content
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.content.store') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <label for="password">Select Horo Type</label>
                                <select class="form-control" id="horo" name="category_id" required>
                                    <option value=""> Please Select Bay Din</option>
                                    @foreach($categories as $category)
                                        @foreach($category->grandchildren as $child)
                                            @foreach($child->grandchildren as $sub_child)
                                                <optgroup label="{{$sub_child->title}}">
                                                    @foreach($sub_child->grandchildren as $grand_child)
                                                        <option value="{{$grand_child->id}}">{{$grand_child->title}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                                <br>
                                <div id="daily"></div>
                                <div id="weekly"></div>
                                <div id="monthly"></div>
                                <div id="type"></div>

                                <label for="horo_image">Image (Optional)</label>
                                <div class="form-group">
                                    <input type="file" name='image' id="horo_image" class="form-control-file"
                                           placeholder="Upload image">
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="content" cols="50" rows="10" class="form-control no-resize"
                                                  required></textarea>
                                        <label class="form-label">Content Here</label>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        $('select').change(function () {
            var selected = $("#horo option:selected").text();
            // alert(selected);
            // $('#p').remove();
            //   $("#daily").append(" <b></b>" + selected);
            if (selected == 'နေ့စဉ်အဟော') {
                $('#weekly').html("");
                $('#monthly').html("");
                $('#daily').html("");
                $("#daily").append(" <label for=\"daily\">For date</label>\n" +
                    "                                <div class=\"form-group\">\n" +
                    "                                    <input type=\"date\" name=\"for_date\" required>\n" +
                    "                                </div>");
                $("#type").html("");
                $('#type').append("<input type=\"hidden\" value=\"dd\" name=\"type\">");
            }
            if (selected == 'အပတ်စဉ်အဟော') {
                $('#daily').html("");
                $('#monthly').html("");
                $('#weekly').html("");
                $("#weekly").append(" <label for=\"weekly\">Start Date</label>\n" +
                    "                                <div class=\"form-group\">\n" +
                    "                                    <input type=\"date\" name=\"start_date\" required>\n" +
                    "                                </div>\n" +
                    "                                <label for=\"horo_image\">End Date</label>\n" +
                    "                                <div class=\"form-group\">\n" +
                    "                                    <input type=\"date\" name=\"end_date\" required>\n" +
                    "                                </div>");
                $("#type").html("");
                $('#type').append("<input type=\"hidden\" value=\"ww\" name=\"type\">");
            }
            if (selected == 'လစဉ်အဟော') {
                $('#daily').html("");
                $('#weekly').html("");
                $('#monthly').html("")
                $("#monthly").append("<label for=\"montly\">For Month</label>\n" +
                    "                              <div class=\"form-group\">\n" +
                    "                                <input type=\"month\" id=\"start\" name=\"for_month\"\n" +
                    "         min=\"2020-01\" value=\"2020-01\" required>\n" +
                    "                              </div>");
                $("#type").html("");
                $('#type').append("<input type=\"hidden\" value=\"mm\" name=\"type\">");
            }
        });
    </script>
@endsection

