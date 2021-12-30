<?php
class Installation {
    public static function getRequirements() {
        return [
            'PHP' => ['info' => 'Required PHP 7.3 or higher', 'value'=> PHP_VERSION >= 7.3],
            'BCMath' => ['info' => 'Required BCMath PHP Extension', 'value' => extension_loaded('bcmath')],
            'Ctype' => ['info' => 'Required Ctype PHP Extension', 'value' => extension_loaded('ctype')],
            'JSON' => ['info' => 'Required JSON PHP Extension', 'value' => extension_loaded('json')],
            'MBstring' => ['info' => 'Required MBstring PHP Extension', 'value' => extension_loaded('mbstring')],
            'OpenSSL'   => ['info' => 'Required OpenSSL PHP Extension', 'value' => extension_loaded('openssl')],
            'PDO'   => ['info' => 'Required PDO PHP Extension', 'value' => defined('PDO::ATTR_DRIVER_NAME')],
            'Tokenizer' => ['info' => 'Required Tokenizer PHP extension', 'value' => extension_loaded('tokenizer')],
            'XML'  =>   ['info' => 'Required XML PHP Extension', 'value' => extension_loaded('xml')],
            'CURL'  => ['info' => 'Required CURL PHP Extension', 'value' => function_exists('curl_version') ],
            'Fileinfo' => ['info' => 'Required Fileinfo PHP Extension', 'value' => extension_loaded('fileinfo')],
            'Gd'    => ['info' => 'Required GD PHP Extension', 'value' => extension_loaded('gd')],
            'EXIF'  => ['info' => 'Required EXIF PHP Extension', 'value' => function_exists('exif_read_data')]
        ];
    }

    public static function getFolders() {
        return [
            '/boostrap/cache' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../bootstrap/cache')],
            '/storage/app' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../storage/app')],
            '/storage/framework' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../storage/framework')],
            '/storage/framework/cache' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../storage/framework/cache')],
            '/storage/framework/sessions' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../storage/framework/sessions')],
            '/storage/logs/' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../storage/logs')],
            '/.env' => ['info' => 'Required Permission: 0775', 'value' => is_writable('../.env')],
        ];
    }

    public static function server($name, $default = null)
    {
        if (isset($_SERVER[$name])) return $_SERVER[$name];
        return $default;
    }
    public static function getHost()
    {
        $request = $_SERVER;
        $host = (isset($request['HTTP_HOST'])) ? $request['HTTP_HOST'] : $request['SERVER_NAME'];

        //remove unwanted characters
        $host = strtolower(preg_replace('/:\d+$/', '', trim($host)));
        //prevent Dos attack
        if ($host && '' !== preg_replace('/(?:^\[)?[a-zA-Z0-9-:\]_]+\.?/', '', $host)) {
            die();
        }

        return $host;
    }
    public static function isSecure()
    {
        return $isSecure = (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == "on") ? true : false;
    }

    public function input($name, $default = false) {
        $post = $_POST;
        if (isset($post[$name])) return $post[$name];
        return $default;
    }

    public static function getScheme()
    {
        return (self::isSecure()) ? 'https' : 'http';
    }
    public static function getRoot()
    {
        $base = self::getBase();

        $url = self::getScheme() . '://' . self::getHost() . $base;
        $url = str_replace('install/', '', $url);
        return $url;
    }

    public static function getBase()
    {
        $filename = basename(self::server('SCRIPT_FILENAME'));
        if (basename(self::server('SCRIPT_NAME')) == $filename) {
            $baseUrl = self::server('SCRIPT_NAME');
        } elseif (basename(self::server('PHP_SELF')) == $filename) {
            $baseUrl = self::server('PHP_SELF');
        } elseif (basename(self::server('ORIG_SCRIPT_NAME')) == $filename) {
            $baseUrl = self::server('ORIG_SCRIPT_NAME');
        } else {
            $baseUrl = self::server('SCRIPT_NAME');
        }

        $baseUrl = str_replace('index.php', '', $baseUrl);

        return $baseUrl;
    }

    public static function processInstall() {
        if (self::input('host')) {
            $driver = 'mysql';
            $host = self::input('host');
            $dbName = self::input('name');
            $dbPort = self::input('port');
            $username =self:: input('username');
            $password = self::input('password');
            $fullName = self::input('fullname');
            $email = self::input('email');

            $siteName = self::input('title');
            try {
                $db = new \PDO("{$driver}:host={$host};dbname={$dbName}", $username, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $configContent = file_get_contents('../.env.example');

                $configContent = str_replace('{DBHOST}', $host, $configContent);
                $configContent = str_replace('{DBUSERNAME}', $username, $configContent);
                $configContent = str_replace('{DBNAME}', $dbName, $configContent);
                $configContent = str_replace('{DBPASSWORD}', $password, $configContent);
                $configContent = str_replace('{DBPORT}', $dbPort, $configContent);
                $configContent = str_replace('{URL}', self::getRoot(), $configContent);
                file_put_contents('../.env', $configContent);
                $sql = file_get_contents('database.sql');
                if ($sql) $db->query($sql);

                $db = new \PDO("{$driver}:host={$host};dbname={$dbName}", $username, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $userPassword = '$2y$10$oCMbNz.aDUU.9UJZBA2AxeePBbz7imJD/UDh6phRdpK5vfJ2v3onO';
                $time = time();
                $res = $db->prepare("INSERT INTO users (name,password,email,role,timezone,created_at,updated_at)VALUES(?,?,?,?,?,?,?)");
                $res->execute(array($fullName,$userPassword,$email,1,'', $time,$time));

                $res = $db->prepare("INSERT INTO settings (settings_key,settings_value)VALUES(?,?)");
                $res->execute(array('site-title', $siteName));

                exit('1');
            } catch (\Exception $e) {
                $message = $e->getMessage();
                exit($message);
            }
        }
    }
}
