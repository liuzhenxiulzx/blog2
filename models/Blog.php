<?php

    namespace models;
    use PDO;
    class Blog extends Base
    {

        public function index(){
            $stmt = self::$pdo -> query("select * from blogs");
            $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            view('index.index',[
                'blog'=>$all
            ]);
        }





















    }

?>