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



}