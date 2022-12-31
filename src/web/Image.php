<?php
    require_once 'DB.php';
    class Image
    {
        public $title;
        public $author;
        public $name;

        public function __construct($title, $author, $name) {
            $this->title = $title;
            $this->author = $author;
            $this->name = $name;
        }
        public function save() {
            $response = DB::get()->images->insertOne([
                'title' => $this->title,
                'contents' => $this->author,
                'name' => $this->name
            ]);
        }

        public static function getAll() {
            $response = DB::get()->images->find([]);
            $posts = [];
            foreach ($response as $image)
                $posts[] = new Image($image['title'], $image['contents'], $image['name']);

            return $posts;
        }
        public static function deleteAll() {
            $response = DB::get()->images->deleteMany([]);
        }
    }