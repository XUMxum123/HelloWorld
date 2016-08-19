<?php

namespace News\Form;

use Zend\Form\Form;

class postForm extends Form {
    public function __construct($name = null, $options = array()){
    	
         parent::__construct($name, $options);

         $this->add(array(
             'name' => 'post-fieldset',
             'type' => 'News\Form\postFieldset',
         	'options' => array(
         		 'use_as_base_fieldset' => true
         	  )
         ));
         
         // <input type="submit" name="submit" value="Insert new Post" />
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