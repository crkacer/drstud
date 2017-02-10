<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class AdminAppController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','MenuBuilder.MenuBuilder'=>array('childrenClass' => null,'firstClass'=>null,'menuClass'=>'main-menu','childrenDropdown'=>null,'activeClass'=>'active opened'));
    public $components = array('Session','Paginator');
    public function authenticate()
    {
        // Check if the session variable User exists, redirect to loginform if not
        if(!$this->Session->check('User'))
        {
            $this->redirect(array('controller' => 'users', 'action' => 'login_form'));
            exit();
        }
    } 
    public function beforeFilter()
    {
        parent::beforeFilter();
        $currAction=strtolower($this->action);
        $currController=strtolower($this->params['controller']);
        if($currController=="admin")
        {
            $this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
            exit();
        }
        if($currAction!='login_form' && $currController!='forgots')
        {
            $this->authenticate();
        }
        if($currAction!='login_form' && $currAction!='myprofile' && $currController!='eldialogs' && $currAction!='changepass' && $currAction!='logout' && $currController!='forgots')
        {
            $userPermissionArr=$this->userPermission();
            $this->userPermissionArr=$userPermissionArr['PageRight'];
            $this->set('userPermissionArr',$this->userPermissionArr);
        }
        $menu=array();
        $mainMenu=array();
        $mainMenu=$this->userMenu('0');
        if($mainMenu)
        {
            $subMenu=array();$menu=array();$dropdownIcon=null;
            foreach($mainMenu as $value)
            {
                $menuPost=$this->userMenu($value['Page']['id']);
                if($menuPost)
                {
                    foreach($menuPost as $menuValue)
                    {
                        $subMenu[]=array(array('title' =>'<i class="'.$menuValue['Page']['icon'].'"></i><span class="submenu-title">'.$menuValue['Page']['page_name'].'</span>','url' => array('controller' => $menuValue['Page']['controller_name'], 'action' => $menuValue['Page']['action_name'])));
                    }
                    $subMenu=call_user_func_array('array_merge',$subMenu);
                    if($subMenu)
                    $dropdownIcon=' <span class="arrow"></span>';
                }
                $menu[] = array(array('title' =>'<i class="'.$value['Page']['icon'].'"></i> <span class="menu-title">'.$value['Page']['page_name'].'</span>'.$dropdownIcon,'url' => array('controller' => $value['Page']['controller_name'], 'action' => $value['Page']['action_name']),'children'=>$subMenu,'selName'=>$value['Page']['sel_name']));
                $subMenu=array();
                $dropdownIcon=null;
            }
            $menu=array('main-menu' =>call_user_func_array('array_merge',$menu));
        }
        $this->set(compact('menu'));
        $this->loadModel('Mail');
        if($this->adminValue['User']['ugroup_id']==1)
        $this->userStatus=false;
        else
        $this->userStatus=true;
        $this->luserId=$this->adminValue['User']['id'];
        $this->userGroupWiseId=$this->userGroup();
    }
    public function userPermission()
    {
        $userPermissionArr=array();
        $this->loadModel('Page');
        $isPermission=true;
        $UserArr=$this->Session->read('User');
        if($UserArr['User']['ugroup_id']!=1)
        {
            $userPermissionArr=$this->Page->find('first',array('joins'=>array(array
                                                                       ('table'=>'page_rights','alias'=>'PageRight','type'=>'Inner',
                                                                        'conditions'=>array('Page.id=PageRight.page_id'))),
                                                        'conditions'=>array('PageRight.ugroup_id'=>$UserArr['User']['ugroup_id'],'LOWER(Page.controller_name)'=>strtolower($this->params['controller'])),
                                                        'fields'=>array('Page.*','PageRight.*')));
            if(/*!isset($userPermissionArr['PageRight']['view_right']) || $userPermissionArr['PageRight']['view_right']==0*/!$userPermissionArr)
            $isPermission=false;
            if($isPermission==false)
            {
                $this->Session->setFlash(__('No Permission'),'flash',array('alert'=>'danger'));
                $this->redirect(array('controller'=>'','action' => 'Dashboards'));
            }
        }
        else
        {
          $userPermissionArr['PageRight']['view_right']=1;
          $userPermissionArr['PageRight']['save_right']=1;
          $userPermissionArr['PageRight']['update_right']=1;
          $userPermissionArr['PageRight']['delete_right']=1;
          $userPermissionArr['PageRight']['search_right']=1;
        }
        return$userPermissionArr;
    }
    public function userMenu($id)
    {
        $UserArr=$this->Session->read('User');
        $this->loadModel('Page');
        if($UserArr['User']['ugroup_id']==1)
        {
            $menuArr=$this->Page->find('all',array('conditions'=>array('parent_id'=>$id,'published'=>'Yes'),'order'=>array('ordering'=>'asc')));
        }
        else
        {
            $menuArr=$this->Page->find('all',array('joins'=>array(array
                                                                   ('table'=>'page_rights','alias'=>'PageRight','type'=>'Inner',
                                                                    'conditions'=>array('Page.id=PageRight.page_id'))),
                                                    'conditions'=>array('PageRight.ugroup_id'=>$UserArr['User']['ugroup_id'],'parent_id'=>$id,'published'=>'Yes'),
                                                    'order'=>array('Page.ordering'=>'asc')));
        }
        return$menuArr;
    }
    public function userGroup()
    {
        $UserArr=$this->Session->read('User');
        $this->loadModel('UserGroup');
        $post=$this->UserGroup->find('all',array('fields'=>'UserGroup.group_id','conditions'=>array('UserGroup.user_id'=>$this->luserId)));
        $userGroupArr=array();
        foreach($post as $v)
        {
            $userGroupArr[]=implode(",",$v['UserGroup']);
        }
        $userGroupList="";
        if(is_array($userGroupArr))
        $userGroupList=implode(",",$userGroupArr);
        if(strlen($userGroupList)==0)
        $userGroupList="''";
        return$userGroupList;
    }
}
