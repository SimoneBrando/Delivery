<?php

namespace View;

class VChef{

    private $smarty;

    public function __construct(bool $logged = false, ?string $role = null, string $error = "") {
        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged, $role, $error);
    }

    public function assignCommonVars(bool $logged, ?string $role = null, string $error = "") {
        $this->smarty->assign('error', $error);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('role', $role);
    }


    public function showOrders($orders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->display('chef_orders.tpl');
    }

    public function showOrdiniInAttesa($orders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->display('waiting_orders.tpl');
    }




}