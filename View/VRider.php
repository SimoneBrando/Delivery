<?php

namespace View;

class VRider{

    private $smarty;

    public function __construct(bool $logged = false, ?string $role = null, array $messages = []) {
        $this->smarty = getSmartyInstance();
        $this->assignCommonVars($logged, $role, $messages);
    }


    public function assignCommonVars(bool $logged, ?string $role = null, array $messages = []) {
        $this->smarty->assign('messages', $messages);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('role', $role);
    }


    public function showOrders($orders, $ordersOnDelivery, $myOrders){
        $this->smarty->assign('orders', $orders);
        $this->smarty->assign('ordersOnDelivery', $ordersOnDelivery);
        $this->smarty->assign('myOrders', $myOrders);
        $this->smarty->display('rider_orders.tpl');
    }

    public function changeStateError(){
        $this->smarty->display('rider_changeState_error.tpl');
    }
}