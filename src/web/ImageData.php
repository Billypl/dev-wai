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
                'contents' => $this->author, //TODO: change for author
                'name' => $this->name
            ]);
        }

        public static function getAll() {
            $response = DB::get()->images->find([]);
            $images = [];
            foreach ($response as $image)
                $images[] = new Image($image['title'], $image['contents'], $image['name']);

            return $images;
        }
        public static function deleteAll() {
            $response = DB::get()->images->deleteMany([]);
        }
    }