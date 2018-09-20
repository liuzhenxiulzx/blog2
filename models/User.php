<?php
    namespace Models;
    use PDO;
    class User extends Base{

        public function getName(){
            return 'tom';
        }

        // 注册
        public function regist($email,$password,$face){
            $stmt = self::$pdo->prepare('INSERT INTO users (email,password,face) VALUES(?,?,?)');
            $stmt->execute([
                $email,
                $password,
                $face
            ]);
        }


    }
?>