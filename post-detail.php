<?php
    include 'data.php';
    include 'functions.php';
    $slug_get = (!empty ($_GET['slug'])) ? $_GET['slug'] : null;

    foreach ($posts as $post) {
        if ($slug_get === $post['slug']) {
            $page_title = $post['title'];
        }
    }

    $this_post = getPost($posts, $slug_get);
    include 'header.php';
?>

<main>

    <?php if($this_post['is_post']){ //se il post esiste ?>

        <div class="post post-detail">
            <h1 class="post__title"><?php echo $this_post['title']; ?></h1>
            <div class="post__date"><?php echo $this_post['date']; ?></div>
            <div class="post__img"><img src="<?php echo $this_post['image']; ?>" alt="<?php echo $this_post['title']; ?>"></div>
            <div class="post__content"><?php echo $this_post['content']; ?></div>
            <div class="post__tag">Tags: <?php echo $this_post['tags']; ?></div>
        </div>
        <div class="post__comments"></div>

    <?php } else { //altrimenti errore ?>

        <h1 class="error"><?php echo $this_post['error']; ?></h1>

    <?php } ?>

</main>

<div class="template template-comment">
    <h2 class="post__comments__title">Commenti</h2>
    <div class="comment">
        <h3 class="comment__name"> - <span class="comment__email"></span></h3>

        <div class="comment__content"></div>
    </div>
</div>



<?php include 'footer.php' ?>
