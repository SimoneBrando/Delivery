<?php

namespace View;

class VProprietario{

    private $smarty;

    public function __construct(bool $logged = false, ?string $role = null) {
        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged, $role);
    }

    public function assignCommonVars(bool $logged, ?string $role = null) {
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('role', $role);
    }


    public function showDashboard($orders, $totaleOggi, $numeroClienti, $ordiniOggi, $mediaValutazioni, $fatturatoSettimana, $nomiTopPiatti, $quantitaTopPiatti){
        $this->smarty->assign('ordini', $orders);
        $this->smarty->assign('totaleOggi', $totaleOggi);
        $this->smarty->assign('numeroClienti', $numeroClienti);
        $this->smarty->assign('ordiniOggi', $ordiniOggi);
        $this->smarty->assign('mediaValutazioni', $mediaValutazioni);
        $this->smarty->assign('fatturatoSettimana', $fatturatoSettimana);
        $this->smarty->assign('nomiPiatti', $nomiTopPiatti);
        $this->smarty->assign('quantitaPiatti', $quantitaTopPiatti);
        $this->smarty->display('dashboard.tpl');
    }

    public function showCreationForm(){
        $this->smarty->display('create_employee.tpl');
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

    public function showSegnalazioni($segnalazioni){
        $this->smarty->assign('segnalazioni', $segnalazioni);
        $this->smarty->display('admin_segnalazioni.tpl');
    }

}