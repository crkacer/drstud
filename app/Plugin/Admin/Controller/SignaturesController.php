<?php
class SignaturesController extends AdminAppController {
    public $helpers = array('Html','Form','Session');
    public $components = array('Session','search-master.Prg');    
    public function index()
    {
        if ($this->request->is('post'))
        {
            try
            {
                $this->Signature->id = 1;
                if ($this->Signature->save($this->request->data))
                {
                    $this->Session->setFlash(__('Signature has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
    }
    public function Signaturedel()
    {
        $post=$this->Signature->findById(1);
        $userResult=array('id'=>1,'signature'=>'');
        $file=APP.WEBROOT_DIR.DS.'img'.DS.$post['Signature']['signature'];
        try
        {
            if($this->Signature->save($userResult))
            {
                if(file_exists($file))
                {
                    unlink($file);
                }
                $this->Session->setFlash(__('Signature has been deleted'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Something wrong'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
?>