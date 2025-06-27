<?php

namespace View;

class VUser{

    private $smarty;

    public function __construct(bool $logged = false, ?string $role = null ){

        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged, $role);

    }

    public function assignCommonVars(bool $logged, ?string $role = null) {
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('role', $role);
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

    public function showLoginForm(string $error = ""){
        $this->smarty->assign('error', $error);
        $this->smarty->display('login.tpl');
    }

    public function showRegisterForm(string $error = ""){
        $this->smarty->assign('error', $error);
        $this->smarty->display('register.tpl');
    }

    public function showChangePassword($user, $userAddresses, $userCreditCard){
        $this->smarty->assign('utente',$user);
        $this->smarty->assign('indirizzi',$userAddresses);
        $this->smarty->assign('carte_credito',$userCreditCard);
        $this->smarty->display('account.tpl');
    }

    public function showConfirmOrder($user, $adresses, $creditCards){
        $this->smarty->assign('utente', $user);
        $this->smarty->assign('indirizzi',$adresses);
        $this->smarty->assign('carte_credito',$creditCards);
        $this->smarty->display('check_order.tpl');
    }

    public function confermedOrder(){
        $this->smarty->display('confermed_order.tpl');
    }

    public function showReviewForm(){
        $this->smarty->display('review_form.tpl');
    }
}