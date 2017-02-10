<?php
class PaymentsController extends AdminAppController {
    public $helpers = array('Html','Form','Session');
    public $components = array('Session');
    public function index()
    {
        try
        {
            $id=1;        
            $post = $this->Payment->findById($id);        
            if ($this->request->is('post'))
            {
                $this->Payment->id = $id;
                try
                {
                    if ($this->Payment->save($this->request->data))
                    {
                        $this->Session->setFlash(__('Paypal Payment Setting has been saved'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash(__('Setting Problem'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            if (!$this->request->data)
            {
                $this->request->data = $post;
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
}
