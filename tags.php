<?php
    include_once 'data.php' ;
    $tags_get = (!empty ($_GET['tag'])) ? $_GET['tag'] : null;

    $tags = [];

    foreach ($posts as $post){
        foreach ($post['tag'] as $tag){
            if(stripos($tag, $tags_get) === 0){
            (stripos($tag, $tags_get));
                if (!in_array($tag, $tags)) {
                    $tags[] = $tag;
                }
            }
        }
    }

    echo json_encode($tags);

?>

