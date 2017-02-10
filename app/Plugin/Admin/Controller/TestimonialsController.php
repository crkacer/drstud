<?php
class TestimonialsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Testimonial.id'=>'desc'));
    public function index()
    {
        try
        {
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = $this->Testimonial->parseCriteria($this->Prg->parsedParams());
            $this->Paginator->settings['limit']=$this->pageLimit;
            $this->Paginator->settings['maxLimit']=$this->maxLimit;
            $this->set('Testimonial', $this->Paginator->paginate());
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
                $this->Testimonial->create();
                try
                {
                    if ($this->Testimonial->save($this->request->data))
                    {
                        $this->Session->setFlash(__('Testimonial has been saved'),'flash',array('alert'=>'success'));
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
            $post[]=$this->Testimonial->findById($id);
        }
        $this->set('Testimonial',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Testimonial->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Testimonial has been updated'),'flash',array('alert'=>'success'));
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
            $this->layout = null;
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
                foreach($this->data['Testimonial']['id'] as $key => $value)
                {
                    $this->Testimonial->delete($value);
                }
                $this->Session->setFlash(__('Testimonial has been deleted'),'flash',array('alert'=>'success'));
            }        
                $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        try
        {
            $this->layout = null;
            if (!$id)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            $post = $this->Testimonial->findById($id);
            if (!$post)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                $this->redirect(array('action' => 'index'));
            }
            if(strlen($post['Testimonial']['photo'])>0)
            $photoImg='testimonial_thumb/'.$post['Testimonial']['photo'];
            else
            $photoImg='blankuser.jpg';
            $this->set('photoImg',$photoImg);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
     public function changephoto($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Testimonial->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->Testimonial->id = $id;
                $this->Testimonial->unbindValidation('keep', array('photo'), true);
                if ($this->Testimonial->save($this->request->data))
                {
                    $this->Session->setFlash(__('Photo Changed Successfully'),'flash',array('alert'=>'success'));
                    $this->redirect(array('action' => 'index'));
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
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
}
