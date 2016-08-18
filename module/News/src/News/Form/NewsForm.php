<?php  

namespace News\Form;

use Zend\Form\Form;

class NewsForm extends Form {
	
   protected $name;
   	
   public function __construct($name = null)
   {
       parent::__construct($name);
       
       $this->setAttribute('method', 'post');
       
       // <input name="id" type="Hidden" value="" />
       $this->add(array(
           'name'=>'id',
           'type'=>'Hidden'
       ));
       
       // Title<input name="title" type="Text" value="" />
       $this->add(array(
           'name'=>'title',
           'type'=>'Text',
           'options'=>array(
               'label'=>'Title: '
           ),
       ));
       
       // Content<input name="content" type="Text" value="" />
       $this->add(array(
           'name'=>'content',
           'type'=>'Text',
           'options'=>array(
               'label'=>'Content: '
           ),
       ));
       
       // <input name="submit" type="submit" id="submit" value="Go" />
       $this->add(array(
           'name'=>'submit',
           'type'=>'submit',
           'attributes'=>array(
               'value'=>'Go',
               'id'=>'submit'
           ),
       ));      
   }
}

