<?php

namespace View;

class VUser{

    private $smarty;

    public function __construct(bool $logged = false, ?string $role = null, array $messages = []){

        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged, $role, $messages);

    }

    public function assignCommonVars(bool $logged, ?string $role = null, array $messages = []) {
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('role', $role);
        $this->smarty->assign('messages', $messages);
    }

    public function showMenu($menu){
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('menu.tpl');
    }

    public function showHome($reviews, bool $logout = false){
        $this->smarty->assign('reviews', $reviews);
        $this->smarty->assign('logout', $logout);
        $this->smarty->display('home.tpl');
    }

    public function order($menu){
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('order.tpl');
    }

    public function dateError(){
        $this->smarty->display('data_non_disponibile.tpl');
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

    public function showForgotPasswordForm(){
        $this->smarty->display('forgot_password.tpl');
    }
}