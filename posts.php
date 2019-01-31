<?php
    include 'data.php';
    include 'functions.php';

    $tag_get = (!empty ($_GET['tag'])) ? $tag_get = $_GET['tag'] : null;
    $posts = (empty ($_GET['tag'])) ? $posts : filterPosts($posts, $tag_get);
?>

<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>
<body>
    <h1 class="page__title">Tutti i Post</h1>
    <?php
    if(count($posts) > 0){
        foreach ($posts as $post){
                $slug = $post['slug'];
                $title = $post['title'];
                $content = $post['content'];
                $content = substr ( $content , 0 , 150);
                $date = getFormatDate($post['published_at']);
            ?>
            <div class="post">
                <a href="post-detail.php/?slug=<?php echo $slug; ?>"><h2 class="post_title"><?php echo $title; ?></h2></a>
                <div class="post_date"><?php echo $date; ?></div>
                <div class="post_content"><?php echo $content; ?> ...</div>
            </div>
    <?php }
    } else { ?>
        <h1 class="error"><?php echo 'Non sono presenti post' ?></h1>
    <?php }?>
</body>
</html>