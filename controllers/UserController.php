<?php
    namespace controllers;
    // 引入模型
    use Models\User;

    class UserController{

        public function user(){
            $user = new User;
            $name = $user->getName();

            view('user.user',[
                'name' => $name
            ]);
        }

        // 注册

        public function registview(){
            view('user.regist');
        }

        public function regist(){

            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $face = $_POST['face'];

            $user = new User;
            $user->regist($email,$password,$face);
          
        }

        // 登录
        public function loginview(){
            view('user.login');
        }

        public function login(){
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $user = new User;
            $user->login($email,$password);

            header('Location:'."http://localhost:8888/blog/index");
        } 














    }
?>