<?php

namespace News\Form;

use Zend\Form\Form;

class postForm extends Form {
    public function __construct($name = null, $options = array()){
         parent::__construct($name, $options);

         $this->add(array(
             'name' => 'post-fieldset',
             'type' => 'News\Form\postFieldset'
         ));

         $this->add(array(
             'type' => 'submit',
             'name' => 'submit',
             'attributes' => array(
                 'value' => 'Insert new Post'
             )
         ));
     }
		
}

?>