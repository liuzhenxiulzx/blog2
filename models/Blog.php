<?php

    namespace models;
    use PDO;
    class Blog extends Base
    {

        public function index(){
            
            // $where 代表所有
            $where = 1;
            // 放预处理对应的值
            $value = [];
            // 关键字搜索
            if(isset($_GET['keyword']) && $_GET['keyword']){
                // $where .= " AND (title like '%{$_GET['keyword']}%' OR content like '%{$_GET['keyword']}%')";   
                $where .= " AND (title like ? OR content like ? )";   
                $value[] = '%'.$_GET['keyword'].'%';
                $value[] = '%'.$_GET['keyword'].'%';
        
         
            }

            // 日期搜索
            if(isset($_GET['start_date']) && $_GET['start_date']){
                $where .=  " AND created_at >= ? ";
                $value[] = $_GET['start_date'];
                
            }
     
            if(isset($_GET['end_date']) && $_GET['end_date']){
                $where .=  " AND created_at <= ? ";
                $value[] = $_GET['end_date'];
    
            }

            // //是否显示
            if(isset($_GET['is_show']) && ($_GET['is_show'] == 1 ||  $_GET['is_show'] === '0') ){
                $where .=  " AND is_show = ? ";
                $value[] = $_GET['is_show'];
         
            }


            // 排序
            $order_by = "created_at";
            $order_way = "desc";

            if(isset($_GET['order_by']) && $_GET['order_by'] == 'display'){
                $order_by = 'display';
            }

            if(isset($_GET['order_way']) && $_GET['order_way'] == 'asc'){
                $order_way = 'asc';
            }


            // ===================翻页===============
            // 每页条数
            $perpage = 15;
            // 接收当前页码（大于等于1的整数） max() 取最大值
            $page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
            // 计算开始的下标
            // 1->0
            // 2->15
            // 3->30
            $offset = ($page-1)*$perpage;
            
            // 制作按钮
            // 取出总的记录数
            $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM blogs WHERE $where");
            $stmt->execute($value);
            $counts = $stmt->fetch(PDO::FETCH_COLUMN); //FETCH_COLUMN 只取数字

            // 计算总的页数 ceil()向上取整 floor()向下取整
            $countpage = ceil($counts/$perpage);
            // echo $countpage;
            // exit;
            $btn = '';
            for($i=1;$i<=$countpage;$i++){
                // 先获取之前的参数 (在搜索，排序...的基础上分页)
                $cspage = getUrlParams(['page']);

                $btn.="<a href='?{$cspage}page=$i'>$i</a>";
            }


            // // 预处理sql
            $stmt = self::$pdo->prepare("SELECT * FROM blogs WHERE $where ORDER BY $order_by $order_way LIMIT $offset,$perpage");
            // var_dump($stmt);
            // 执行sql
            $stmt->execute($value);
            // $error = self::$pdo->errorInfo();
            // echo "<pre>";
            // var_dump($error);

            // 取数据
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            view('blogs.index',[
                'blog'=>$data,
                'btn'=>$btn,
            ]);
        }

        
        // 取出所有数据生成静态页
        public function static_page(){
            $stmt = self::$pdo->query('select * from blogs');
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        // 取出浏览量
        public function getdisplay(){
            $stmt->self::$pdo->prepare('SELECT display FROM blog WHERE id=?');
            $stmt->execute($id);
            return $stmt->fetch(PDO::FETCH_COLUMN);
   
        }


        // 发表日志
        public function report($title,$content,$is_show){
           
            $stmt = self::$pdo->prepare('INSERT INTO blogs (title,content,created_at,is_show) VALUES(?,?,now(),?)');
            $data =  $stmt->execute([
                $title,
                $content,
                $is_show,
            ]);

            if(!$data){
                echo "发表失败";
                $error = $stmt->errorInfo();
                echo "<pre>";
                var_dump($error);

                exit;
            }else{
                return true;
            }
            // 返回新插入的记录的ID
            // return self::$pdo->lastInsertId();
            
        }

        // 修改日志
        // public function modify(){
        //     $stmt =  self::$pdo->prepare('UPDATE INTO blogs()')
        // }


















    }

?>