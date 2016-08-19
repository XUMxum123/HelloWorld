<?php

namespace News\Form;

use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;
use News\Model\post;

class postFieldset extends Fieldset {
   public function __construct($name = null, $options = array()){
         parent::__construct($name, $options);
         
         $this->setHydrator(new ClassMethods(false));
         $this->setObject(new post());
         
         // <input type="hidden" name="id" value="" />
         $this->add(array(
             'type' => 'hidden',
             'name' => 'id',
         ));
         
         // The Title: <input type="text" name="title" value="" />
         $this->add(array(
             'type' => 'text',
             'name' => 'title',
             'options' => array(
                 'label' => 'The Title: ',
             ),
         	'attributes' => array(
         		 'value' => 'write title here'
         	 )
         ));
         
         // The Content: <input type="text" name="content" value="" />
         $this->add(array(
             'type' => 'text',
             'name' => 'content',
             'options' => array(
                 'label' => 'The Content: ',
             ),
           'attributes' => array(
         		'value' => 'write content here'
         	 )
         ));
     }	
}

?>