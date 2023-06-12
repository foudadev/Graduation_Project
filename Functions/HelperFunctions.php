<?php

function UploadImage($conn, $image_name, $targetImagePath) {

    $imageType = pathinfo($targetImagePath,PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg');
    // check extention of image
    if(in_array($imageType, $allowTypes)) {
        // Upload file to server
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetImagePath)) {
            return 1;
        } else {
            echo alert("image uplaod failed", 0);
        }
    }
}

function alert($text, $status) {
    if ($status == 1) {
        $_SESSION['alert'] = '<div class="alert alert-success text-center">' .  $text .'</div>';
    } else {
        $_SESSION['alert'] = '<div class="alert alert-danger text-center">' .  $text .'</div>';
    }
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}

function UploadVideo($conn, $video_name, $targetVideoPath) {

    $videoType = pathinfo($targetVideoPath,PATHINFO_EXTENSION);
    $allowTypes = array('mp4','mov');
    // check extention of video
    if(in_array($videoType, $allowTypes)) {
        // Upload file to server
        if(move_uploaded_file($_FILES["video"]["tmp_name"], $targetVideoPath)) {
            return 1;
        } else {
            echo alert("video uplaod failed", 0);
        }
    }
}