<?php
    class Question
    {
        private $conn;

        public $id;
        public $title;
        public $answer_a;
        public $answer_b;
        public $answer_c;
        public $answer_d;
        public $true_answer;

        //db connection
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //read data
        public function read()
        {
            $query = "SELECT * FROM question ORDER BY id DESC";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            return $stmt;
        }

        public function show()
        {
            $query = "SELECT * FROM question WHERE id=? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->answer_a = $row['answer_a'];
            $this->answer_b = $row['answer_b'];
            $this->answer_c = $row['answer_c'];
            $this->answer_d = $row['answer_d'];
            $this->true_answer = $row['true_answer'];
        }

        public function create()
        {
            $query = "INSERT INTO question SET title=:title, answer_a=:answer_a, answer_b=:answer_b, answer_c=:answer_c, answer_d=:answer_d, true_answer=:true_answer";
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->answer_a = htmlspecialchars(strip_tags($this->answer_a));
            $this->answer_b = htmlspecialchars(strip_tags($this->answer_b));
            $this->answer_c = htmlspecialchars(strip_tags($this->answer_c));
            $this->answer_d = htmlspecialchars(strip_tags($this->answer_d));
            $this->true_answer = htmlspecialchars(strip_tags($this->true_answer));

            $stmt->bindParam(':title',$this->title);
            $stmt->bindParam(':answer_a',$this->answer_a);
            $stmt->bindParam(':answer_b',$this->answer_b);
            $stmt->bindParam(':answer_c',$this->answer_c);
            $stmt->bindParam(':answer_d',$this->answer_d);
            $stmt->bindParam(':true_answer',$this->true_answer);
            
            if($stmt->execute())
            {
                return true;
            }
            printf("Có lỗi xuất hiện: ", $stmt->error);
            return false;
        }

        public function update()
        {
            $query = "UPDATE question SET title=:title, answer_a=:answer_a, answer_b=:answer_b, answer_c=:answer_c, answer_d=:answer_d, true_answer=:true_answer
                        WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->answer_a = htmlspecialchars(strip_tags($this->answer_a));
            $this->answer_b = htmlspecialchars(strip_tags($this->answer_b));
            $this->answer_c = htmlspecialchars(strip_tags($this->answer_c));
            $this->answer_d = htmlspecialchars(strip_tags($this->answer_d));
            $this->true_answer = htmlspecialchars(strip_tags($this->true_answer));

            $stmt->bindParam(':id',$this->id);
            $stmt->bindParam(':title',$this->title);
            $stmt->bindParam(':answer_a',$this->answer_a);
            $stmt->bindParam(':answer_b',$this->answer_b);
            $stmt->bindParam(':answer_c',$this->answer_c);
            $stmt->bindParam(':answer_d',$this->answer_d);
            $stmt->bindParam(':true_answer',$this->true_answer);
            
            if($stmt->execute())
            {
                return true;
            }
            printf("Có lỗi xuất hiện: ", $stmt->error);
            return false;
        }

        public function delete()
        {
            $query = "DELETE FROM question WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id',$this->id);
            
            if($stmt->execute())
            {
                return true;
            }
            printf("Có lỗi xuất hiện: ", $stmt->error);
            return false;
        }
    }

?>