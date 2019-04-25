@extends('layouts.app')

@section('content')

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-9 blog-body">

            <div class="panel panel-default">
                <div class="panel-body">

                    <!-- /.input-group -->

                    <h2 class="page-header">
                        Home
                        <small></small>
                    </h2>


                    <div class="col-md-12">

                        <div class="panel panel-body">

                            <!-- Blog Search Well -->
                            <div class="col-md-9 col-sm-8 col-xs-8">

                                <div class="input-group">
                                    <input type="text" class="form-control" name="search_key">
                                    <span class="input-group-btn">
                                        <button class="search btn btn-default" type="button">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                                </div>

                            </div>


                            <div class="col-md-3 col-sm-4 col-xs-4">
                                <button id="addBlog" class="btn c-button" type="button" data-toggle="modal">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    ADD NEW POST
                                </button>
                            </div>

                        </div>

                    </div>


                    @if(sizeof($blogs) > 0)
                        @foreach ($blogs as $key => $blog)

                            <h3>
                                <a href="{{ url('blog', ['id' => $blog->id]) }}">{{ $blog->title }}</a>
                            </h3>
                            <h4>
                                by {{ $blog->user->name }}
                            </h4>
                            <p><span class="glyphicon glyphicon-time"></span> Posted
                                on {{ date("d/m/Y H:i:s", strtotime($blog->created_at)) }}</p>

                            <?php
                                // to show sample picture
                                preg_match_all('/<img[^>]+>/i', $blog->body, $result);
                            ?>
                            @if(sizeof($result[0]) > 0)
                                <p class="post_body">
                                    {!! $result[0][0] !!}
                                </p>
                            @endif

                            <span class="text-warning">
                            <i class="glyphicon glyphicon-comment" aria-hidden="true"></i>
                                {{$blog->comment_count}} comments
                            </span>
                            <a class="btn r-button" href="{{ url('blog', ['id' => $blog->id]) }}" style="float: right">Read
                                More <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>


                            <hr>

                        @endforeach

                        <hr>

                        <!-- Pager -->
                        <ul class="pager">
                            {!! $blogs->links() !!}
                        </ul>
                    @else
                        <h4 style="text-align: center"> There is no content found !</h4>
                    @endif

                </div>

            </div>


            <!----- New Blog ----------->

            <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
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
                            <h4 class="modal-title" id="modalAddBrandLabel">Add New Blog</h4>

                        </div>
                        <div class="modal-body">
                            <form>
                                {{csrf_field()}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label>Title</label>
                                <input name="title" id="title" type="text" class="form-control"
                                       required="required"
                                       placeholder="Enter Title">
                                <br/>
                                        <textarea name="description" id="txt" rows="10" cols="80">
                                            Prepare your blog here
                                        </textarea>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn e-button" data-dismiss="modal">Close</button>
                            <button id="saveBlog" type="button" class="btn c-button">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
@endsection