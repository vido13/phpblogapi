<?php
    class Category {
        private $conn;
        private $table = 'categories';

        public $id;
        public $name;
        public $created_at;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
            $stmt = $this->conn->prepare($query);
            if($stmt->execute()){
                return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function read_single(){
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){
                return $stmt;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;

        }

        public function create(){
            $query = 'INSERT INTO ' . $this->table . '
            SET name = :name';
            $stmt = $this->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $stmt->bindParam(':name', $this->name);

            if($stmt->exectue()){
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }


    }