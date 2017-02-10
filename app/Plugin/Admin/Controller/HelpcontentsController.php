<?php
class HelpcontentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Helpcontent.id'=>'desc'));
    public function index()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = $this->Helpcontent->parseCriteria($this->Prg->parsedParams());
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('Helpcontent', $this->Paginator->paginate());
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
            $this->Helpcontent->create();
            try
            {
                if ($this->Helpcontent->save($this->request->data))
                {
                    $this->Session->setFlash(__('Help content has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->Helpcontent->findByid($id);
        }
        $this->set('Helpcontent',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Helpcontent->id = $id;
            try
            {
                if ($this->Helpcontent->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Help content has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
               
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = 'tinymce';
            $this->set('isError',false);
        }   
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Helpcontent']['id'] as $key => $value)
                {
                    $this->Helpcontent->delete($value);
                }
                $this->Session->setFlash(__('Help content has been deleted'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
