<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonUser for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
		'routes' => array(
			'task' => array(
				'type'    => 'segment',
					'options' => array(
						'route'    => '/checklist[/:action][/:id][/page/:page]',
							'constraints' => array(
								 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								 'id'     => '[a-zA-Z0-9_-]*[a-zA-Z0-9_-]*',  // first letter / second letter
								 'page'   => '[0-9]+',
							 ),
							'defaults' => array(
                                 '__NAMESPACE__' => 'Checklist\Controller',
                                 'controller'    => 'Task',
                                 'action'        => 'index',
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
            'Checklist\Controller\Task' => 'Checklist\Controller\TaskController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
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
            'checklist/task/index' => __DIR__ . '/../view/checklist/task/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
