<?php

namespace View;

class VProprietario{

    private $smarty;

    public function __construct(){

        $this->smarty = getSmartyInstance();

    }

    public function showDashboard(){
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $this->smarty->display('dashboard.tpl');
    }

    public function showPanel($orders, $ordiniSettimana, $totaleSettimana, $numeroClienti){
        $this->smarty->assign('ordiniSettimana', $ordiniSettimana);
        $this->smarty->assign('totaleSettimana', $totaleSettimana);
        $this->smarty->assign('numeroClienti', $numeroClienti);
        $this->smarty->assign('orders',$orders);
        $this->smarty->display('admin_panel.tpl');
    }

    public function showReviews($allReviews){
        $this->smarty->assign('reviews', $allReviews);
        $this->smarty->display('recensioni_admin.tpl');
    }

    public function showMenu($prodotti){
        $this->smarty->assign('products', $prodotti);
        $this->smarty->display('menu_admin.tpl');
    }

    public function showOrders($allOrders){
        $this->smarty->assign('orders', $allOrders);
        $this->smarty->display('admin_order.tpl');
    }

    public function showCreateAccount($chefs, $riders){
        $this->smarty->assign('chefs', $chefs);
        $this->smarty->assign('riders', $riders);
        $this->smarty->display('create_account_admin.tpl');
    }

}