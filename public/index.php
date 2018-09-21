<?php

    // 定义常量 
    define('ROOT',dirname(__FILE__).'/../');

    // 类的自动加载 
    // controller\IndexController
    function autoload($class){

        $path = str_replace('\\','/',$class);

        require(ROOT.$path.'.php');
    }
    
    // 注册函数
    spl_autoload_register('autoload');

    // 解析路由：解析URL上的路径：控制器/方法
    // 获取URL上的路径
    if(isset($_SERVER['PATH_INFO'])){
        //  /blog/index
        $pathInfo = $_SERVER['PATH_INFO'];
        // 根据/ 转成数组
        $pathInfo = explode('/',$pathInfo);
        // 得到控制器名和方法名
        $controller =ucfirst($pathInfo[1]).'Controller';
        $action = $pathInfo[2];

    }else{
        // 默认控制器和方法名
        $controller = "IndexController";
        $action = 'index';
    }

    // 为控制添加命名空间
    $fullController = 'controllers\\'.$controller;

    $_c = new $fullController;
    $_c->$action();


// 加载视图
//如： view('user.user',[
//     'name' => $name
// ]);
// 参数一：加载的视图的文件名 
// 参数二：向视图传的参数 
function view($filename,$data=[]){

    // 解压数组成变量  
    extract($data);

    $viewpath = str_replace('.','/',$filename).'.html';

    // 加载视图
    require(ROOT.'views/'.$viewpath);
}


















?>