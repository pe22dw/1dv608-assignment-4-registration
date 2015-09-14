<?php

class LoginController {
    
    private $loginModel;
    private $loginView;
    private $userName;
    private $userPassword;
    
    public function __construct($loginModel, $loginView) {
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
    }
    
    public function checkIfLogin() {
        if($this->loginView->getRequestLogin()) {
		    $this->userName = $this->loginView->getRequestUserName();
			$this->userPassword = $this->loginView->getRequestPassword();
			$this->verifyLogin();
        }
    }
    
    public function verifyLogin() {
        $userNameToVerify = $this->userName;
        $userPasswordToVerify = $this->userPassword;
        $this->loginModel->compareLogin($userNameToVerify, $userPasswordToVerify);
        $this->loginView->getCurrentState();
    }
    
    public function checkIfLogout() {
        if($this->loginView->getRequestLogout()) {
            $this->loginModel->setIsLoggedOut(true);
            $this->loginView->getCurrentState();
        }
    }
}