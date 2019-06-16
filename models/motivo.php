<?php
    class Motivo{
        // database connection and table name
        private $conn;
        private $table_name = "motivos_es_gt";
    
        // object properties
        public $motivo;
        public $des_motivo;
        public $estado;
        public $tipo;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        /**
        * Return all rows in the table
        * @return array
        */
        public function all() {
            $sql = "SELECT * FROM " . $this->table_name . " p ORDER BY p.motivo DESC";
            $stmt = $this->conn->query($sql);
            $motivos = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $motivos[] = [
                    'motivo' => $row['motivo'],
                    'desc' => $row['des_motivo'],
                    'estado' => $row['estado'],
                    'tipo' => $row['tipo']
                ];
            }
            return $motivos;
        }
    }
?>