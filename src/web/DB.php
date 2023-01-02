<?php
    // double include to ensure it works in prod and dev
    // "@" to silent warning
    @include '/var/www/dev/src/vendor/autoload.php';
    @include '/var/www/prod/src/vendor/autoload.php';
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

