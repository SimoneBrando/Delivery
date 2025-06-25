<?php

namespace Controller;

use Delight\Auth\Auth;
use Entity\EUtente;
use Exception;
use Foundation\FPersistentManager;
use Services\Utility\UCookie;
use Services\Utility\USession;
use View\VUser;
use View\VErrors;   

require_once __DIR__ . '/../View/VUser.php';
require_once __DIR__ . '/../View/VErrors.php';
require_once __DIR__ . '/../Foundation/FPersistentManager.php';
require_once __DIR__ . '/../Entity/EUtente.php';
require_once __DIR__ . '/../services/utility/UHTTPMethods.php';
require_once __DIR__ . '/../services/utility/USession.php';
require_once __DIR__ . '/../services/utility/UCookie.php';


abstract class BaseController{
    protected FPersistentManager $persistent_manager;
    protected Auth $auth_manager;
    protected array $validRoles;

    public function __construct() {
        $this->persistent_manager = FPersistentManager::getInstance();
        $this->auth_manager = getAuth();
        $this->validRoles = ['cliente', 'cuoco', 'rider', 'proprietario'];
    }

    public function requireLogin() {
        if(!($this->isLoggedIn())){
            $view = new VUser();
            $view->showLoginForm();
            exit;
        }
    }

    public function requireRole(string $role) {
        if (!in_array($role, $this->validRoles, true)) {
            throw new \InvalidArgumentException('Invalid role: ' . $role . 'passed to requireRole()');
        }
        $this->requireLogin();
        $userRole = $this->getUser()->getRuolo();
        if (!($userRole == $role)){
            $view = new VErrors();
            $view->showAccessDenied();
            exit;
        }
    }

    public function requireRoles(array $roles) {
        foreach ($roles as $role) {
            if (!in_array($role, $this->validRoles, true)) {
                throw new \InvalidArgumentException("Invalid role in requireAnyRole: $role");
            }
        }
        $this->requireLogin();
        $userRole = $this->getUser()->getRuolo();
        if (!in_array($userRole, $roles, true)) {
            $view = new VErrors();
            $view->showAccessDenied();
            exit;
        }
    }

    public function isLoggedIn(): bool {
        return $this->auth_manager->isLoggedIn();
    }
    
    public static function isLogged(){
        $logged = false;
        if(UCookie::isSet('PHPSESSID')){
            if(session_status() == PHP_SESSION_NONE){
                USession::getInstance();
            }
        }
        if(USession::isSetSessionElement('user')){
            $logged = true;
        }
        return $logged;
    }

    public function getUserId(): int {
        return $this->auth_manager->getUserId();
    }

    public function getUser(): EUtente {
        $userId = $this->getUserId();
        $user = $this->persistent_manager->getObjOnAttribute(EUtente::class,'user_id',$userId);
        if (!$user) {
            throw new \UnexpectedValueException('Utente autenticato non trovato nel database.');
        }
        return $user;
    }

    public function handleFatalError(Exception $error){
        USession::destroySession();
        $this->auth_manager->logout();
        USession::unsetSessionElement('user');
        $view = new VErrors();
        $view->showFatalError($error->getMessage());
    }

    public function handleError(Exception $error){
        $view = new VErrors();
        $view->showFatalError($error->getMessage());
    }
}