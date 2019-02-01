<?php
    include 'data-comments.php';
    include 'functions.php';

    $slug_get = (!empty ($_GET['slug'])) ? $_GET['slug'] : null;
    $json = [];

    foreach ($comments as $slug => $this_comments){
        if($slug_get === $slug){
            foreach ($this_comments as $this_comment){
                $json[] = $this_comment;
            }
        }
    }

    echo json_encode($json);
?>