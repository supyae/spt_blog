@if(sizeof($comments) > 0)

    <ul>
        @foreach($comments as $comment)
            <li>
                <p align='left' class="commentp">
                    by {{ $comment->user->name }} . {{ $comment->created_at }}
                </p>
                {{ $comment->message }}



                <a onclick="event.preventDefault();
                        if({{Auth::guest()}}) location.href='/login?custom_redirect=/blog/' + {{$blog->id}};return false;"
                   href="#" align='right' class="reply_icon"
                   data-parentid="{{$comment->id}}" data-toggle="modal"
                   data-target="#reply{{$comment->id}}">
                    <i class="glyphicon glyphicon-comment"></i>
                    Reply
                </a>

                <div class="modal fade" id="reply{{$comment->id}}" tabindex="-1" role="dialog"
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
                                <h4 class="modal-title" id="modalAddBrandLabel">Reply Comment</h4>

                            </div>
                            <div class="modal-body">
                                <form>
                                    {{csrf_field()}}

                            <textarea id="message{{$comment->id}}" required="required" name="message" rows="5" cols="50" style="width: 100%"></textarea>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn e-button" data-dismiss="modal">Close</button>
                                <button data-parentid="{{$comment->id}}"
                                        data-blogid ="{{$blog->id}}"
                                        type="button" class="replyComment btn c-button">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                @if(sizeof($comment->reply) > 0)
                    @include('blog.comment', ['comments' => $comment->reply])
                @endif
            </li>

            <hr>

        @endforeach
    </ul>
@else
    <h4>There is no comment here.</h4>

@endif