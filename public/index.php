<?php
    // 项目根目录
    define('ROOT',dirname(__FILE__).'/../');
    // 类加载函数
    function autoLoadClass($class){
        require_once ROOT.str_replace('\\','/',$class).'.php';
    }
    // 注册加载函数
    spl_autoload_register('autoLoadClass');
    // 视图加载函数
    function view($file,$data=[]){
        // 如果传递了数据，就把数组展开成比变量
        if($data){
            extract($data);
            // extract 把数组转成变量
        }
        // 加载视图文件
        require_once ROOT.'views/'.str_replace('.','/',$file).'.html';

    }
    
        // 解析路由
        function route(){
            // 获取URL
            $url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] :'/';
            // 定义默认的控制器和方法
            $defaultController = "IndexController";
            $defaultAction = "index";

            if($url == '/'){

                return [
                    $defaultController,
                    $defaultAction
                ];

            }else if(strpos($url,'/',1) !== FALSE){

                // 去掉第一个
                $url = ltrim($url,'/');
                // 取出控制器和方法
                $route = explode('/',$url);
                // 格式化控制器名，比如 user => UserController
                $route[0] = ucfirst($route[0].'Controller');
                return $route;

            }else{
                die('请求的URL格式不正确');
            }
        }
        $route = route();

        // 任务分发到控制器
        $controller = "controllers\\{$route[0]}";
        $action = $route[1];
        // 创建控制器对象
        $_c = new $controller;
        $_c->$action();
?>