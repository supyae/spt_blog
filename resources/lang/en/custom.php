<?php

use Illuminate\Support\Facades\Auth;

if (Auth::guest()) {
    $edit_blog = "Login to edit your blog";
} else {
    $edit_blog = "Edit";
}

return [
    'edit_blog' => $edit_blog,
    'add-success' => "Successfully added !",
    'add-fail' => "It was failed to add !"
];


?>