<?php
    require_once '../DB.php';
    class User
    {
        public $login;
        public $email;
        public $password;
        public $id;

        public function __construct($login, $email, $password, $id)
        {
            $this->login = $login;
            $this->email = $email;
            $this->password = $password;
            if($id == false)
                $this->id = new \MongoDB\BSON\ObjectId();
        }

        public function saveToDb()
        {
            DB::get()->users->insertOne([
                'login' => $this->login,
                'email' => $this->email,
                'password' => $this->password,
                'id' => $this->id
            ]);
        }

        public static function getAll()
        {
            $response = DB::get()->users->find([]);
            $users = [];
            foreach ($response as $user)
                $users[] = new User($user['login'], $user['email'], $user['password'], $user['id']);

            return $users;
        }

        public static function deleteAll()
        {
            DB::get()->users->deleteMany([]);
        }
    }