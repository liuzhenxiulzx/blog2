<?php
    namespace controllers;
    // 引入模型
    use models\Blog;

    class BlogController{
        // 首页
        public function index(){

            $blogs = new Blog;
            $data  =  $blogs->index();
            
        }

        // 生成静态页
        public function Static_page(){
            $blog = new Blog();
            $data = $blog->static_page();  
      
            // 开启缓冲区
            ob_start();

            // 生成静态页
            foreach($data as $v){
                // 加载视图
                view('blogs.content',[
                    'blog'=>$v
                ]);
          
                // 取出缓冲区的内容
                $blog_content = ob_get_contents();
                
                // 生成静态页
                file_put_contents(ROOT.'public/contents/'.$v['id'].'.html', $blog_content );
                // 清空缓冲区
                ob_clean();
             }
        }
















    }
?>