@extends('.layouts.app')

@section('content')

    @include('alert')
    <div class="row">

        <div class="col-md-10 blog-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <!-- /.input-group -->

                    <h2 class="page-header">
                        Blog Detail
                        <small></small>
                    </h2>

                    <h3>
                        <a href="#">{{ $blog->title }}</a>
                    </h3>
                    <h4>
                        by {{ $blog->user->name }}
                    </h4>

                    <!----- Edit Blog Section ---------->

                    @if(Auth::check() && Auth::user()->id == $blog->user_id)
                        <button class="editBlog btn c-button" style="float:right;">
                            <i class="glyphicon glyphicon-edit"></i>&nbsp;
                            {{ \Illuminate\Support\Facades\Lang::get('custom.edit_blog') }}
                        </button>
                    @elseif(Auth::check() && Auth::user()->id != $blog->user_id)

                    @else
                        <button class="editBlog btn c-button" style="float:right;">
                            <i class="glyphicon glyphicon-log-in"></i>&nbsp;
                            {{ \Illuminate\Support\Facades\Lang::get('custom.edit_blog') }}
                        </button>
                    @endif


                    <p><span class="glyphicon glyphicon-time"></span> Posted
                        on {{ date("d/m/Y H:i:s", strtotime($blog->created_at)) }}</p>
                    {{--<hr>--}}
                    {{--<img class="img-responsive" src="{{ url('/upload/blog1.jpg') }}" alt="">--}}
                    {{--<hr>--}}
                    <p>
                        {!! $blog->body !!}
                    </p>

                    <br/>


                    <!-- Comment Section ---->

                    <input type="hidden" value="{{ $blog->id }}" name="blog_id">
                    <div class="col-md-12">
                        <form id="newComment" class="form-horizontal" role="form" method="POST"
                              action="{{ url('comment') }}">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="hidden" value="{{ $blog->id }}" name="blog_id">

                                <div class="form-group">
                                    <div class="col-md-8 col-sm-6 col-xs-6">
                                        <textarea id="new_message" rows="5" style="width: 100%" name='message'
                                                  required="required"
                                                  placeholder="Your comment here !"></textarea>

                                    </div>
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                    <div class="col-md-4">
                                        <button class="newComment btn c-button">
                                            Post
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="post">
                            @include('blog.comment')

                        </div>

                    </div>
                </div>
            </div>

            <!---- Edit Panel ---->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                 aria-labelledby="modalAddBrandLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">

                            <div class="col-md-12">
                                <div class="alert alert-success hidden" id="success-alert">
                                    <div class="success_msg"></div>
                                </div>

                                <div class="alert alert-danger hidden" id="success-alert">
                                    <div class="fail_msg"></div>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="modalAddBrandLabel"> Edit Blog</h4>

                        </div>
                        <div class="modal-body">
                            <form>
                                {{csrf_field()}}
                                <label>Title</label>
                                <input name="title" id="title" type="text" class="form-control"
                                       required="required"
                                       placeholder="Enter Title" value="{{ $blog->title }}">
                                <br/>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <textarea name="description" id="edit_txt" rows="10" cols="80">
                                {!! $blog->body !!}
                            </textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn e-button" data-dismiss="modal">Close</button>
                            <button id="updateBlog" type="button" class="btn c-button">Update</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /.row -->
@endsection