<?php
class ContentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Content.link_name'=>'asc'));
    public function index()
    {
        try{
        return $this->redirect(array('action' => 'pages'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }    
    public function pages()
    {
        try{
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Content->parseCriteria($this->Prg->parsedParams());
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Content', $this->Paginator->paginate());
        if ($this->request->is('ajax'))
        {
            $this->render('pages','ajax'); // View, Layout
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Content->create();
            try
            {
                if ($this->Content->save($this->request->data))
                {
                    $this->Session->setFlash(__('Page Added Successfully'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'pages'));
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
            $post[]=$this->Content->findById($id);
        }
        $this->set('Content',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Content->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Pages updated Successfully'),'flash',array('alert'=>'success'));
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
        try{
        if ($this->request->is('post'))
        {
            foreach($this->data['Content']['id'] as $key => $value)
            {
                $this->Content->delete($value);
            }
            $this->Session->setFlash(__('Page has been deleted'),'flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'pages'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
        
    }
    public function published($id=null,$mode=null)
    {
        if (!$id || !$mode)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'pages'));
        }
        $post = $this->Content->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'pages'));
        }
        
        $this->Content->id = $id;
        try
        {
            $published="";
            if($mode=="Yes")
            {
                $publishedValue="Unpublished";
                $published=__('Page has been Unpublished');
            }
            else
            {
                $publishedValue="Published";   
                $published=__('Page has been Published');
            }
            $userArr=array('id'=>$id,'published'=>$publishedValue);
            $this->Content->unbindValidation('remove', array('link_name','ordering','url'), true);
            if ($this->Content->save($userArr))
            {
                $this->Session->setFlash($published,'flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'pages'));
            }
            else
            {
                $this->Session->setFlash(__('Something wrong'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'pages'));            
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'pages'));            
        }
    }
}
