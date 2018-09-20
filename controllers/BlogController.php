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


        //发表日志
        public function report_view(){
            view('blogs.write');
        } 

        public function report(){

            $title = $_POST['title'];
            $content = $_POST['content'];
            $is_show = $_POST['is_show'];

            $blog = new Blog();
            $data = $blog->report($title,$content,$is_show);

            if($data){
                header('Location:'."/blog/index");
            }else{
                echo "日志发表失败";
            }
        }
            
        //修改日志
        // public function modify(){
        //     $blog = new Blog;
        //     $blog -> modify();

        // } 















    }
?>