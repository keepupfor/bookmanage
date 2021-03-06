﻿<?php
return array(
    //'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => 'bdm28103326.my3w.com', // 服务器地址
    'DB_NAME'               => 'bdm28103326_db',          // 数据库名
    'DB_USER'               => 'bdm28103326',      // 用户名
    'DB_PWD'                => '458103210',          // 密码
    'DB_PORT'               => '3306',
    'DB_PREFIX' => 'book_',// 表前缀
    'DB_FIELDTYPE_CHECK'    => false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       => true,        // 启用字段缓存
    'DB_CHARSET'            => 'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        => 0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        => false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         => 1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           => '', // 指定从服务器序号
    'DB_SQL_BUILD_CACHE'    => false, // 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    => 'file',   // SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   => 20, // SQL缓存的队列长度
    'DB_SQL_LOG'            => APP_DEBUG, // SQL执行日志记录
    'URL_MODEL'             => 2,

    'LOG_RECORD'            =>  true,   // 默认不记录日志
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR,INFO',// 允许记录的日志级别
    'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志

//    'MODULE_ALLOW_LIST'    =>    array('Weixin'),
    'DEFAULT_MODULE'       =>   'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
//    'LOAD_EXT_FILE' =>'extfunction',

);
