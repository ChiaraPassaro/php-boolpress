<?php
    function getFormatDate($date){
        $date_timestamp = strtotime(str_replace('/', '-', $date));

        setlocale(LC_ALL, 'it_IT.UTF-8');
        $month = ucfirst(strftime("%B", strtotime($date_timestamp)));
        $day = strftime("%d", strtotime($date_timestamp));
        $hour = strftime("%H", strtotime($date_timestamp));
        return $day . ' ' . $month . ' alle ' . $hour;
    }

    function filterPosts($posts, $tag){
        $filteredPosts = [];
        foreach ($posts as $post){
            if(in_array($tag, $post['tag'])){
                $filteredPosts[] = $post;
            }
        }
        return $filteredPosts;
    }

    function getPost($posts, $slug_get){
        //setto is_post false
        $data_post = [
            'is_post' => false
        ];

        foreach ($posts as $post) {
            if ($slug_get === $post['slug']){
                $title = $post['title'];
                $date = getFormatDate($post['published_at']);
                $img = $post['image'];
                $content = $post['content'];
                $tags = implode(', ', $post['tag']);
                $data_post = [
                    'title' => $title,
                    'date' => $date,
                    'img' => $img,
                    'content' => $content,
                    'tags' => $tags,
                    'is_post' => true
                ];
            }
        }

        //se is_post non è true
        if (!$data_post['is_post']){
                $data_post = [
                    'is_post' => false,
                    'error' => 'La pagina non esiste'
                ];
        }

        return $data_post;
    }
?>