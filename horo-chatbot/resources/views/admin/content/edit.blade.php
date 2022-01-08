@extends('admin.layouts.master')
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit Content
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.content.update',$content->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <label for="password">Select Horo Type</label>
                                <select class="form-control" name="category_id">
                                    {{--<select class="form-control" name="category_id">--}}
                                        @foreach($categories as $category)
                                            @foreach($category->grandchildren as $child)
                                                @foreach($child->grandchildren as $sub_child)
                                                    <optgroup label="{{$sub_child->title}}">
                                                        @foreach($sub_child->grandchildren as $grand_child)
                                                            <option value="{{$grand_child->id}}" {{$content->category->id == $grand_child->id?'selected':''}}>{{$grand_child->title}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {{--@foreach($categories as $category)--}}
                                        {{--@foreach($category->grandchildren as $sub)--}}
                                            {{--<optgroup label="{{$sub->title}}">--}}
                                                {{--@foreach($sub->grandchildren as $subsub)--}}
                                                    {{--<option value="{{$subsub->id}}" {{$content->category->title == $subsub->title?'selected':''}}>{{$subsub->title}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</optgroup>--}}
                                        {{--@endforeach--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                                <br>

                                <img src="{{asset("storage/".$content->image)}}" alt="" style="width: 150px;">
                                <br><br>
                                {{--                                <label for="horo_image">Image (Optional)</label>--}}
                                <div class="form-group">
                                    <input type="file" name='image' id="horo_image" class="form-control-file"
                                           placeholder="Upload image">
                                </div>

                                <label for="horo_image">For date</label>
                                <div class="form-group">
                                    <input type="date" name="for_date" value="{{$content->for_date}}">
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea name="content" cols="30" rows="15" class="form-control no-resize"
                                                  required>
                                            {{$content->content}}
                                        </textarea>
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

@endsection

