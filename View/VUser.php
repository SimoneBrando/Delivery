<?php

namespace View;

class VUser{

    private $smarty;

    public function __construct(){

        $this->smarty = getSmartyInstance();

    }

    public function showMenu($menu){
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('menu.tpl');
    }

    public function showHome(){
        $this->smarty->display('home.tpl');
    }

    public function order($menu){
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('order.tpl');
    }
}