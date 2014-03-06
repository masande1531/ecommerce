<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AppController extends Controller{
    var $pageTitle = 'Ecommrce';
    var $sid;
    var $catId;
    var $pdId;
    
    var $users = array('Product', 'Category', 'Cart');
    var $helpers = array('Form', 'Html', 'Session', 'Javascript');
    var $components = array('Session', 'RequestHandler', 'Shp');
    
    function beforeFilter() {
        if(isset($this->passedArgs['cat_id']) && (int)  $this->passedArgs['cat_id'] != 1){
            $this->catId = (int)  $this->passedArgs['cat_id'];
        }  else {
            $this->catId = 0;
        }
        
        if(isset($this->passedArgs['pd_id']) && $this->passedArgs['pd_id'] != ''){            
            $this->pdId = (int)  $this->passedArgs['pd_id'];
        }  else {
            $this->pdId = 0;
        }
        
        $data = $this->Session->read();
        $this->sid = $data['Config']['UserAgent'];
        $this->set('catId', $this->catId);
        $this->set('pdId', $this->sid);
        $this->setPageTitle();
    }
    
    function setPageTitle(){
        if($this->pdId > 0){
            $result = $this->Product->find('all',
                    array('condtions' => array('Product.id'=>  $this->pdId)));
            $this->pageTitle = $result[0]['Product']['name'];
        }else if($this->catId > 0){
            $result = $this->Category->find('all',
                    array('conditions'=>array('Category.id'=>  $this->catId)));
            $this->pageTitle = $result[0]['Category']['name'];
        }
    }
    
}
?>
