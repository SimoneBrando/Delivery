<?php

namespace View;

class VErrors{

    private $smarty;
    public function __construct(){
        $this->smarty = getSmartyInstance();
    }

    public function showAccessDenied(){
        $this->smarty->display('access_denied.tpl');
    }

    public function showFatalError($message){
        $this->smarty->assign('message', $message);
        $this->smarty->display('fatal_error.tpl');
    }
}