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
    }
?>