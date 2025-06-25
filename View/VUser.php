<?php

namespace View;

use CUser;

require_once __DIR__ . '/../Controller/CUser.php';

class VUser{

    private $smarty;

    public function __construct(bool $logged){

        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged);

    }

    public function assignCommonVars(bool $logged) {
        $this->smarty->assign('logged', $logged);
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

    public function showAddressForm(){
        $this->smarty->display('address_form.tpl');
    }

    public function showCreditCardForm(){
        $this->smarty->display('credit_card_form.tpl');
    }

    public function showReviewForm(){
        $this->smarty->display('review_form.tpl');
    }
}