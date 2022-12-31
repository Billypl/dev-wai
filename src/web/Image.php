<?php
    require_once 'DB.php';
    class Image {
        public $title;
        public $author;

        public function __construct($title, $contents) {
            $this->title = $title;
            $this->author = $contents;
        }

        public function save() {
            $response = DB::get()->images->insertOne([
                'title' => $this->title,
                'contents' => $this->author
            ]);
        }

        public static function getAll() {
            $response = DB::get()->images->find([]);
            $posts = [];
            foreach ($response as $post) {
                $posts[] = new Image($post['title'], $post['contents']);
            }

            return $posts;
        }
    }