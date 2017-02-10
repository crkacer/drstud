<?php
App::uses('AppController', 'Controller');
class CartsController extends AppController
{
    public $uses = array('Package','Cart');
    
    public function buy()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('prodId');
        if (!$id)
        {
            return $this->redirect(array('action' => 'view'));
        }
        $post=$this->Package->findById($id);
        if(!$post)
        return $this->redirect(array('action' => 'view'));
        $this->Cart->addPackage($id);
        echo $this->Cart->getCount();
    }
    public function view()
    {
        $carts = $this->Cart->readPackage();
        $products = array();
        if (null!=$carts)
        {
            foreach ($carts as $productId => $count)
            {
                $product = $this->Package->read(null,$productId);
                $product['Package']['count'] = $count;
                $products[]=$product;
            }
        }
        $this->set(compact('products'));
    }
    public function update()
    {
        if ($this->request->is('post'))
        {
            if(!empty($this->request->data))
            {
                $cart = array();
                foreach ($this->request->data['Cart']['count'] as $index=>$count)
                {
                    if ($count>0)
                    {
                        $productId = $this->request->data['Cart']['package_id'][$index];
                        $cart[$productId] = $count;
                    }
                }
                $this->Cart->savePackage($cart);
            }
        }
        $this->redirect(array('action'=>'view'));
    }
    public function delete($id=null)
    {
        if (!$id)
        {
            return $this->redirect(array('action' => 'view'));
        }
        $carts = $this->Cart->readPackage();
        unset($carts[$id]);
        $this->Cart->savePackage($carts);
        $this->redirect(array('action'=>'view'));
    }
    public function viewajax()
    {
        $this->layout = null;
        $this->view();
    }
}