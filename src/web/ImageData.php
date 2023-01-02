<?php
    require_once 'DB.php';
    class ImageData
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
            DB::get()->images->insertOne([
                'title' => $this->title,
                'author' => $this->author,
                'name' => $this->name
            ]);
        }

        public static function getAll() {
            $response = DB::get()->images->find([]);
            $images = [];
            foreach ($response as $image)
                $images[] = new ImageData($image['title'], $image['author'], $image['name']);

            return $images;
        }
        public static function deleteAll() {
            DB::get()->images->deleteMany([]);
        }
    }