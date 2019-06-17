<?php 
    class Database{
        /**
         * Connection
         * @var type 
         */
        private static $conn;
    
        /**
         * Connect to the database and return an instance of \PDO object
         * @return \PDO
         * @throws \Exception
         */
        public function connect() {
    
            // read parameters in the ini configuration file
            $params = parse_ini_file('database.ini');
            if ($params === false) {
                throw new \Exception("Error reading database configuration file");
            }
            // connect to the postgresql database
            $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                    $params['host'], 
                    $params['port'], 
                    $params['database'], 
                    $params['user'], 
                    $params['password']);
    
            $conn = new \PDO($conStr);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
            return $conn;
        }
    
        /**
         * return an instance of the Connection object
         * @return type
         */
        public static function get() {
            if (null === static::$conn) {
                static::$conn = new static();
            }
    
            return static::$conn;
        }
    }
?>