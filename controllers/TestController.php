<?php
    namespace controllers;

    class TestController{

        public function register(){
            $redis = \libs\Redis::getredis();
            // 消息队列的信息
            $data = [
                'email' => 'liuzhenxiu@126.com',
                'title' => '标题',
                'content' => '内容',
            ];

            // 转成数组
            $data = json_encode($data);
            // 取数据
            $redis->lpush('email',$data);
            echo '注册成功！';
        }

         public function mail(){

            ini_set('default_socket_timeout', -1); 
            echo "邮件程序已启动....等待中...";
            $redis = \libs\Redis::getredis();
            // 循环监听一个列表
            while(true)
            {
                // 从队列中取数据，设置为永久不超时
                $data = $redis->brpop('email', 0);
                echo '开始发邮件';
                // 处理数据
                var_dump($data);
                echo "发完邮件，继续等待\r\n";
            }  

         }



         public function testmail(){
            // 设置邮件服务器账号
            $transport = (new \Swift_SmtpTransport('smtp.126.com', 25))  // 邮件服务器IP地址和端口号
            ->setUsername('liuzhenxiu@126.com')       // 发邮件账号
            ->setPassword('lzx123');      // 授权码

            // 创建发邮件对象
            $mailer = new \Swift_Mailer($transport);            

            // 创建邮件消息
            $message = new \Swift_Message();
            $message->setSubject('邮件的标题')   // 标题
            ->setFrom(['liuzhenxiu@126.com' => 'liuzhenxiu'])   // 发件人
            ->setTo(['liuzhenxiu@126.com', 'liuzhenxiu@126.com' => 'ftd'])   // 收件人
            ->setBody('Hello <a href="http://localhost:8888">点击激活</a> World ~', 'text/html');     // 邮件内容及邮件内容类型

            // 发送邮件
            $mailer->send($message);
         }











    }

?>