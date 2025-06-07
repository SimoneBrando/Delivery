<?php

namespace View;

class VUser{

    private $smarty;

    public function __construct(){

        $this->smarty = getSmartyInstance();

    }

    public function prova(){
        $this->smarty->assign('titolo', 'Prova Smarty');
        $this->smarty->assign('nome', 'Simone');
        $this->smarty->display('prova.tpl');
    }

    public function showMenu($menu){
        $this->smarty->assign('menu', $menu);
        $this->smarty->display('menu.tpl');
    }

    public function showHome(){
        $this->smarty->display('home.tpl');
    }

    public function showLoginForm(){
        $this->smarty->display('login.html');
    }

    public function showRegisterForm(){
        $this->smarty->display('registrati.html');
    }
}