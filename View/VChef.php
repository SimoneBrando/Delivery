<?php

namespace View;

class VChef{

    private $smarty;

    public function __construct(){

        $this->smarty = getSmartyInstance();

    }

    public function showOrders($orders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->display('chef_orders.tpl');
    }




}