<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	'db' => array(
			'driver'         => 'Pdo',
			'dsn'            => 'mysql:dbname=test;host=localhost',
			'driver_options' => array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		 ),
	),
	'service_manager' => array(
			'factories' => array(
				'Zend\Db\Adapter\Adapter'
					=> 'Zend\Db\Adapter\AdapterServiceFactory',
		 ),
	),
/* 	 'common_function' => array(
            'function' => array(
                'uuid' => function($prefix='',$sub){
                	$chars = md5(uniqid(mt_rand(), true));
                	$uuid  = substr($chars,0,8);
                	$uuid .= substr($chars,8,4);
                	$uuid .= substr($chars,12,4);
                	$uuid .= substr($chars,16,4);
                	$uuid .= substr($chars,20,12);
                	return $prefix.$sub.$uuid;
             },
               'another_uuid' => function($prefix=''){
                	$chars = md5(uniqid(mt_rand(), true));
                	$uuid  = substr($chars,0,8);
                	$uuid .= substr($chars,8,4);
                	$uuid .= substr($chars,12,4);
                	$uuid .= substr($chars,16,4);
                	$uuid .= substr($chars,20,12);
                	return $prefix.$uuid;
             },
	      ),
     ) */
);

/*  another method to link mysql database
 *
 *
       'db' => array(
        'driver'         => 'MYSQLI',
        'dbname'         => 'test',
        'host'           => 'localhost',
        'options' => array(
                'buffer_results' => true
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),

 *
 * */