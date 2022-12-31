<?php
    require '/var/www/dev/src/vendor/autoload.php';
    //TODO: fix absolute path
    class DB
    {
        private static $db = null;

        public static function get()
        {
            if (!isset(static::$db))
            {
                static::$db = new MongoDB\Client(
                    "mongodb://127.0.0.1:27017/wai",
                    [
                        'username' => 'wai_web',
                        'password' => 'w@i_w3b'
                    ]
                );
            }
            return static::$db->wai;
        }
    }