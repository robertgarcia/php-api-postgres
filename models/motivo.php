<?php
    class Motivo{
        // database connection and table name
        private $conn;
        private $table_name = " motivos_es_gt ";
    
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

        /**
         * insert a new row into the table
         * @return boolean
         */
        public function save() {
            $go = false;
            try {
                // prepare statement for insert
                $sql = " INSERT INTO " . $this->table_name . "(motivo, des_motivo, estado, tipo) VALUES (:motivo, :des_motivo, :estado, :tipo)";
                $stmt = $this->conn->prepare($sql);
    
                // sanitize
                $this->motivo=htmlspecialchars(strip_tags($this->motivo));
                $this->des_motivo=htmlspecialchars(strip_tags($this->des_motivo));
                $this->estado=htmlspecialchars(strip_tags($this->estado));
                $this->tipo=htmlspecialchars(strip_tags($this->tipo));
    
                // pass values to the statement
                $stmt->bindValue(':motivo', $this->motivo);
                $stmt->bindValue(':des_motivo', $this->des_motivo);
                $stmt->bindValue(':estado', $this->estado);
                $stmt->bindValue(':tipo', $this->tipo);
                
                // execute the insert statement
                if($stmt->execute()){
                    $go = true;
                }
            } catch (\PDOException $e) {
                //print_r($e);
                //throw new \Exception("DataBase Error!");
            }

            return $go;
        }

         /**
         * Update stock based on the specified id
         * @return int
         */
        public function update() {
    
            // sql statement to update a row in the stock table
            $sql = 'UPDATE '. $this->table_name
                    . ' SET '
                    . 'des_motivo = :des_motivo, '
                    . 'estado = :estado, '
                    . 'tipo = :tipo, '
                    . 'WHERE motivo = :motivo';
    
            $stmt = $this->pdo->prepare($sql);
    
            // bind values to the statement
            $stmt->bindValue(':des_motivo', $this->des_motivo);
            $stmt->bindValue(':estado', $this->estado);
            $stmt->bindValue(':tipo', $this->tipo);
            $stmt->bindValue(':motivo', $this->motivo);
            
            // update data in the database
            $stmt->execute();
    
            // return the number of row affected
            return $stmt->rowCount();
        }

    }
?>