<?php
class ConfigurationsController extends AdminAppController {
    public $helpers = array('Html','Form','Session');
    public $components = array('Session','search-master.Prg');    
    public function index()
    {
        
        $this->loadModel('Currency');
        $this->set('currency',$this->Currency->find('list',array('fields'=>array('id','name'))));
        $language=array('en'=>__('English'));
        $id=1;        
        $post = $this->Configuration->findById($id); 
        if ($this->request->is('post'))
        {
            $this->Configuration->id = $id;
            try
            {
                if ($this->Configuration->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Setting has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
        $this->set('language',$language);
    }    
}
?>