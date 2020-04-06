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
            $stmt->execute();
            return $stmt;
        }

        public function read_single(){
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $row['name'];

        }


    }