<?php  
  

    // 动态的修改 php.ini 配置文件
    ini_set('session.save_handler', 'redis');   // 使用 redis 保存 SESSION
    ini_set('session.save_path', 'tcp://127.0.0.1:6379?database=1');  // 设置 redis 服务器的地址、端口、使用的数据库
 
    session_start();

    // 定义常量  
    define('ROOT',dirname(__FILE__).'/../');

    // 引入redis
    require(ROOT.'/vendor/autoload.php');
    
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
    if(php_sapi_name()=='cli'){

        $controller = ucfirst($argv[1]).'Controller';
        $action = $argv[2];

    }else{

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





// 获取当前 URL 上所有的参数，并且还能排除掉某些参数
// 参数：要排除的变量
function getUrlParams($except = [])
{
    // ['odby','odway']
    // 循环删除变量
    foreach($except as $v)
    {
        unset($_GET[$v]);

        // unset($_GET['odby']);
        // unset($_GET['odway']);
    }

    /*
    $_GET['keyword'] = 'xzb';
    $_GET['is_show] = 1

    // 拼出：  keyword=abc&is_show=1
    */

    $str = '';
    foreach($_GET as $k => $v)
    {
        $str .= "$k=$v&";
    }

    return $str;

}













?>