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

    public function showHome($reviews){
        $this->smarty->assign('reviews', $reviews);
        $this->smarty->display('home.tpl');
    }

    public function order($menu){
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('order.tpl');
    }

    public function showMyOrders($orders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->display('miei_ordini.tpl');
    }

    public function showLoginForm(){
        $this->smarty->display('login.tpl');
    }

    public function showRegisterForm(){
        $this->smarty->display('register.tpl');
    }

    public function showChangePassword($user){
        $this->smarty->assign('utente',$user);
        $this->smarty->display('account.tpl');
    }
}