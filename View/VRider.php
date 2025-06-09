<?php

namespace View;

class VRider{

    private $smarty;

    public function __construct(){

        $this->smarty = getSmartyInstance();

    }

    public function showOrders($orders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->display('rider_orders.tpl');
    }




}