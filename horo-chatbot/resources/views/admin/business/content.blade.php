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
                            <form action="{{ route('admin.business.content.deliver') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" name="id" value="{{ $id }}">

                                <label for="horo_image">Upload Content File (mp3, mp4, pdf) </label>
                                <div class="form-group">
                                    <input type="file" name='file' id="horo_image" class="form-control-file"
                                           placeholder="Upload File Content">
                                </div>

                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

