<?php
class CurrenciesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('name'=>'asc'));
    public function index()
    {
        try{
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Currency->parseCriteria($this->Prg->parsedParams());
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Currency', $this->Paginator->paginate());
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }    
    public function add()
    {
        if ($this->request->is('post'))
        {
            if ($this->request->is('post'))
            {
                $this->Currency->create();
                try
                {
                    if ($this->Currency->save($this->request->data))
                    {
                        $this->Session->setFlash(__('Currency has been saved'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'add'));
                    }
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                }
            }
        }
    }    
    public function deleteall()
    {
        try{
        if ($this->request->is('post'))
        {
            foreach($this->data['Currency']['id'] as $key => $value)
            {
                $this->Currency->delete($value);
            }
            $this->Session->setFlash(__('Currency has been deleted'),'flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
}
