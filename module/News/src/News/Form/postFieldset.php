<?php

namespace News\Form;

use Zend\Form\Fieldset;

class postFieldset extends Fieldset {
   public function __construct($name = null, $options = array()){
         parent::__construct($name, $options);

         $this->add(array(
             'type' => 'hidden',
             'name' => 'id'
         ));

         $this->add(array(
             'type' => 'text',
             'name' => 'title',
             'options' => array(
                 'label' => 'The Title'
             )
         ));

         $this->add(array(
             'type' => 'text',
             'name' => 'content',
             'options' => array(
                 'label' => 'The content'
             )
         ));
     }	
}

?>