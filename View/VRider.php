<?php

namespace View;

class VRider{

    private $smarty;

    public function __construct(bool $logged = false, ?string $role = null) {
        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged, $role);
    }


    public function assignCommonVars(bool $logged, ?string $role = null) {
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('role', $role);
    }


    public function showOrders($orders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->display('rider_orders.tpl');
    }




}