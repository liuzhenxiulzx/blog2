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

        // 登录
        public function login($email,$password){
            $stmt = self::$pdo->prepare('SELECT FROM users WHERE eamil=? , password=?');
            $stmt->execute([
                $email,
                $password,
            ]);
           return  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
           if($data){
               
               $_SESSION['id']=$user['id'];
               $_SESSION['email'] ==  $data['email'];
               $_SESSION['password'] == $data['password']  ;
               return true;

           }else{
               return false;
           }
        }
    }
?>