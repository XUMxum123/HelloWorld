<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonUser for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/* $news = array(
	'type'    => 'Literal',
	'options' => array(
		'route'    => '/news',
		'defaults' => array(
			'__NAMESPACE__' => 'News\Controller',
			'controller'    => 'Index',
			'action'        => 'index',
		),
	),
);

$news_list = array(
	'type'    => 'Literal',
	'options' => array(
		'route'    => '/list',
		'defaults' => array(
			'__NAMESPACE__' => 'News\Controller',
			'controller'    => 'Index',
			'action'        => 'list',
		),
	),
);

$news_edit = array(
	'type'    => 'Literal',
	'options' => array(
		'route'    => '/edit',
		'defaults' => array(
		     '__NAMESPACE__' => 'News\Controller',
			 'controller'    => 'Index',
			 'action'        => 'edit',
		),
	),
);

$news_delete = array(
	'type'    => 'Literal',
	'options' => array(
		'route'    => '/delete',
		'defaults' => array(
			 '__NAMESPACE__' => 'News\Controller',
			 'controller'    => 'Index',
			 'action'        => 'delete',
		),
	),
);

$news_add = array(
	'type'    => 'Literal',
	'options' => array(
		'route'    => '/add',
		'defaults' => array(
			 '__NAMESPACE__' => 'News\Controller',
			 'controller'    => 'Index',
			 'action'        => 'add',
		),
	),
);

$news["may_terminate"] = true;
$news["child_routes"]["list"] = $news_list;
$news["child_routes"]["edit"] = $news_edit;
$news["child_routes"]["delete"] = $news_delete;
$news["child_routes"]["add"] = $news_add; */

return array(		
/* 	'router' => array(
		'routes' => array(
		  'news' => $news,
	    ),
    ), */
    'router' => array(
		'routes' => array(
			'news' => array(
				'type'    => 'segment',
					'options' => array(
						'route'    => '/news[/:action][/:id][/page/:page]',
							'constraints' => array(
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								 'id'     => '[a-zA-Z0-9_-]*[a-zA-Z0-9_-]*',  // first letter / second letter
								 'page'   => '[0-9]+',
							 ),
							'defaults' => array(
								 'controller' => 'News\Controller\Index',
								 'action'     => 'index',
							 ),
					 ),
			 ),
		),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'News\Controller\Index' => 'News\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'news/index/index' => __DIR__ . '/../view/news/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);

/*      'router' => array(  // add comment by xum
 'routes' => array(
 		'home' => array(
 				'type' => 'Zend\Mvc\Router\Http\Literal',
 				'options' => array(
 						'route'    => '/',
 						'defaults' => array(
 								'controller' => 'Application\Controller\Index',
 								'action'     => 'index',
 						),
 				),
 		),    // add comment by xum
 		// The following is a route to simplify getting started creating
 		// new controllers and actions without needing to create a new
 		// module. Simply drop new controllers in, and you can access them
 		// using the path /application/:controller/:action
 		/*             'user' => array(
 				'type'    => 'Literal',
 				'options' => array(
 						'route'    => '/user',
 						'defaults' => array(
 								'__NAMESPACE__' => 'User\Controller',
 								'controller'    => 'Index',
 								'action'        => 'index',
 						),
 				),
 				'may_terminate' => true,
 				'child_routes' => array(
 						'default' => array(
 								'type'    => 'Segment',
 								'options' => array(
 										'route'    => '/[:controller[/:action]]',
 										'constraints' => array(
 												'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
 												'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
 										),
 										'defaults' => array(
 										),
 								),
 						),
 				),
 		), */

 		/*            'login' => array(
 		 'type'    => 'Literal',
 				'options' => array(
 						'route'    => '/user/login',
 						'defaults' => array(
 								'__NAMESPACE__' => 'User\Controller',
 								'controller'    => 'Index',
 								'action'        => 'login',
 						),
 				),
 				'may_terminate' => true,
 		), */
 
 		/*            'register' => array(
 		 'type'    => 'Literal',
 				'options' => array(
 						'route'    => '/user/register',
 						'defaults' => array(
 								'__NAMESPACE__' => 'User\Controller',
 								'controller'    => 'Index',
 								'action'        => 'register',
 						),
 				),
 				'may_terminate' => true,
 		), */
 		/*
 		 ),
),  */

