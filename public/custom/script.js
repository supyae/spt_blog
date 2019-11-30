$(document).ready(function () {

    /***** Add Blog Modal ***/
    $('#addBlog').click(function (e) {
        // CKEDITOR.replace('txt');
        // fixUnfocus();


        var guest = $('input[name="guest"]').val();
        if (guest == '1') {
            window.location.href = "/login";
        }
        else {
            $('#addModal').modal();
            CKEDITOR.replace('txt');
            fixUnfocus();
        }
    });

    /****** Save Blog *****/
    $('#saveBlog').click(function (e) {
        var title = $("#title").val();
        var body = CKEDITOR.instances['txt'].getData();
        var url = "/blog";

        var data = {'title': title, 'body': body};
        saveData('POST', data, url);

    });


    /***** Edit Blog Modal*****/
    $(".editBlog").click(function (e) {
        var guest = $('input[name="guest"]').val();
        var blog_id = $('input[name="blog_id"]').val();
        if (guest == '1') {
            window.location.href = "/login?custom_redirect=/blog/" + blog_id;
        }
        else {
            $('#editModal').modal();
            CKEDITOR.replace('edit_txt');
            fixUnfocus();
        }
    });

    /****** Update Blog *****/
    $("#updateBlog").click(function (e) {

        var url = "/blog";

        var title = $("#title").val();
        var blog_id = $('input[name="blog_id"]').val();
        var body = CKEDITOR.instances['edit_txt'].getData();

        var data = {'title': title, 'body': body, 'blog_id': blog_id};

        saveData('PUT', data, url);
    });


    /***** New Comment *****/
    $("#newComment").click(function (e) {
        var guest = $('input[name="guest"]').val();
        var blog_id = $('input[name="blog_id"]').val();
        var message = $("#new_message").val();
        if (guest == '1') {
            window.location.href = "/login?custom_redirect=/blog/" + blog_id;
        }
        else {
           if (message != '') $("#newComment").submit();
        }
    });

    /**** Reply Comment **/
    $(".replyComment").click(function (e) {

        var url = "/comment";
        var parent_id = $(this).attr('data-parentid');
        var blog_id = $(this).attr('data-blogid');
        var message = $("#message" + parent_id).val();
        var data = {
            'parent_id': parent_id,
            'blog_id': blog_id,
            'message': message
        };
        saveData("POST", data, url);
    });



    /*** Search Data ***/
    $(".search").click(function (e) {
        var search_key = $('input[name="search_key"]').val();
        var route = '/';
        if (search_key != '') {
            route = "/search?q=" + search_key;
        }
        window.location.href = route
    });



    /** Save Post Data To Server **/
    function saveData(method, data = {}, route) {
        //data["_token"] = "{{ csrf_token() }}";
        data["_token"] = $('input[name="_token"]').val();

        $.ajax({
            url: route,
            method: method,
            data: data,
            success: function () {
                console.log()
                showSuccessMsg('Successful !');
            },
            error: function () {
                showSuccessMsg('Failed !', true);
            }
        });
    }

    function fixUnfocus() {
        $.fn.modal.Constructor.prototype.enforceFocus = function () {
            modal_this = this;
            $(document).on('focusin.modal', function (e) {
                if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
                    // add whatever conditions you need here:
                    && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
                    modal_this.$element.focus()
                }
            })
        };
    }

    /****** To Show up Message Info ****/
    function showSuccessMsg(str='', fail = false) {
        var div = "success_msg";
        if (fail) {
            div = "fail_msg";
        }
        var selector = $("." + div);

        selector.parent('div').removeClass('hidden');
        selector.html('Content was ' + str);
        selector.fadeTo(800, 500).slideUp(500, function () {
            selector.slideUp(500);
            selector.parent('div').addClass('hidden');

            if (!fail) {
                $('.close').click();
                location.reload(true);
            }

        });
    }
});
