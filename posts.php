<?php
    include 'data.php';
    include 'functions.php';

    $tag_get = (!empty ($_GET['tag'])) ? $tag_get = $_GET['tag'] : null;
    $posts = (empty ($_GET['tag'])) ? $posts : filterPosts($posts, $tag_get);

    $page_title = 'Tutti i Post';
    include 'header.php';
?>

<main>
    <h1 class="page__title">Tutti i Post</h1>

    <?php include "search-bar.php";?>

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
                <a href="post-detail.php/?slug=<?php echo $slug; ?>"><h2 class="post__title"><?php echo $title; ?></h2></a>
                <div class="post__date"><?php echo $date; ?></div>
                <div class="post__content"><?php echo $content; ?> ...</div>
            </div>

    <?php }
    } else { ?>
        <h1 class="error"><?php echo 'Non sono presenti post' ?></h1>
    <?php }?>

</main>

<?php include 'footer.php' ?>