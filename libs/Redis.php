<?php
    namespace libs;
    // 单例模式
    class Redis {
        // 私有的静态属性
        private static $redis = null;
        // 私有的克隆方法
        private function __clone(){}
        // 私有的构造方法
        private function __construct(){}
        // 公共的方法，连接redis
        public function getredis(){
            // 如果还没有 redis 就生成一个
            // 只有每 一次 才会连接
            if(self::$redis === null){
                self::$redis = new \Predis\Client([
                    'scheme' => 'tcp',
                    'host'   => '127.0.0.1',
                    'port'   => 6379,
                    'database' => 1,
                ]);
            }
            // 返回已有的redis对象
            return self::$redis;
        }
        
    }
?>