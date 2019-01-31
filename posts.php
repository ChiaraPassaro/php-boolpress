<?php include 'data.php';
    include 'functions.php'?>

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
    <h1 class="page__title">All Posts</h1>
    <?php foreach ($posts as $post){
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
    <?php } ?>
</body>
</html>