<?php
    include 'data.php';
    include 'functions.php';
    $slug_get = (!empty ($_GET['slug'])) ? $_GET['slug'] : null;

    foreach ($posts as $post) {
        if ($slug_get === $post['slug']) {
            $page_title = $post['title'];
        }
    }

    include 'header.php';
?>
    <main>
            <?php
                    foreach ($posts as $post) {
                        if ($slug_get === $post['slug']){
                            $title = $post['title'];
                            $date = getFormatDate($post['published_at']);
                            $img = $post['image'];
                            $content = $post['content'];
                            $tags = implode(', ', $post['tag']);
                            $is_post = true;
                        } else{
                         $message_error = 'La pagina non esiste';
                        }
                    }
            ?>

            <?php if(isset($is_post)){ ?>
                <div class="post-detail">
                    <h1 class="post__title"><?php echo $title; ?></h1>
                    <div class="post__date"><?php echo $date; ?></div>
                    <div class="post__img"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>"></div>
                    <div class="post__content"><?php echo $content; ?></div>
                    <div class="post__tag">Tags: <?php echo $tags; ?></div>
                </div>
                <div class="post__comments"></div>
            <?php } else { ?>
                <h1 class="error"><?php echo $message_error; ?></h1>
            <?php } ?>
        </main>

        <div class="template template-comment">
            <h2 class="post__comments__title">Commenti</h2>
            <div class="comment">
                <h3 class="comment__name"> - <span class="comment__email"></span></h3>

                <div class="comment__content"></div>
            </div>
        </div>
        <script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/php-boolpress/dist/js/main.js" type="text/javascript"></script>
<?php include 'footer.php' ?>
