<?php
    namespace controllers;
    // 引入模型
    use Models\User;

    class UserController{


        // // 大文件上传--合并
        // public function uploadbig(){

        //     $img = $_FILES['img']; //
        //     $count = $_POST['count'];
        //     $i = $_POST['i'];
        //     $size = $_POST['size'];

        // }



        // 上传头像
        public function faceview(){
            view('user.face');
        }
 
        public function face(){
            // 先创建目录
            $root = ROOT.'public/uploads/';
            // 今天日期
            $time =  date('Ymd');
            // 如果没有这个目录则创建目录
            if(!is_dir($root.$time)){
                // 创建目录
                mkdir($root.$time,0777);
            }

            // 生成唯一的名字
            $name = md5( time().rand(1,9999) );

            // 取出原来这个图片的后缀
            // strrchr : 从最后一个字符开始截取到最后
            $ext = strrchr($_FILES['face']['name'],'.'); //.jpg
            $name = $name.$ext;
            // 移动图片
             move_uploaded_file($_FILES['face']['tmp_name'],$root.$time.'/'.$name);
        }


        // 上传相册
        public function Album(){
            view('user.Album');
        }

        public function uploadAlbums(){

             // 先创建目录
             $root = ROOT.'public/uploads/';
             // 今天日期
             $time =  date('Ymd');
             // 如果没有这个目录则创建目录
             if(!is_dir($root.$time)){
                 // 创建目录
                 mkdir($root.$time,0777);
             }

            foreach($_FILES['images']['name'] as $k=>$v){
              
                $name = md5( time().rand(1,9999) );
                $ext = strrchr($v,'.'); 
                $name = $name.$ext;
                move_uploaded_file($_FILES['images']['tmp_name'][$k],$root.$time.'/'.$name);
            }

        }






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
            if($user->login($email,$password)){
                 header('Location:'."http://localhost:8888/blog/index");
            }else{
                echo "邮箱或密码错误";
            }

           
        } 














    }
?>