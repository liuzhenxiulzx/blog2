<?php
    namespace controllers;
    // 引入模型
    use models\Blog;

    class BlogController{
        
        public function index(){

            $blogs = new Blog;
            $data  =  $blogs->index();
            
        }

















    }
?>