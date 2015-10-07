<?php

class LoginModel {
    
    private $userCatalogue;
    private $userNameEmpty = false;
    private $userPasswordEmpty = false;
    private $isLoggedIn = false;
    private $isLoggedOut = false;
    private $isAlreadyLoggedIn = false;
    
    public function __construct($userCatalogue) {
        assert($userCatalogue instanceof UserCatalogue, 'First argument was not an instance of UserCatalogue');
        
        $this->userCatalogue = $userCatalogue;
    }
	
	public function doTryToLogin($userName, $userPassword) {
	    assert(is_string($userName), 'First argument was not a string');
	    assert(is_string($userPassword), 'Second argument was not a string');
	    
	    if($this->checkIfEmptyName($userName)) {
	        $this->userNameEmpty = true;
	    }
	    else if($this->checkIfEmptyPassword($userPassword)) {
	        $this->userPasswordEmpty = true;
	    }
	    else if($this->checkIfCorrectName($userName)) {
	        if($this->checkIfCorrectPassword($userPassword)) {
	            $this->isLoggedIn = true;
	        }
	    }
	}
	
	public function doLogout() {
        $this->isLoggedOut = true;
        $this->isLoggedIn = false;
        $this->isAlreadyLoggedIn = false;
	}
	
	//Methods for validating the input.
	
	public function checkIfEmptyName($userName) {
	    return empty($userName);
	}	
	
	public function checkIfEmptyPassword($userPassword) {
	    return empty($userPassword);
	}
	
    public function checkIfCorrectName($userName) {
        $users = $this->userCatalogue->getUsers();
        return in_array($userName, $users);
    }
    
    public function checkIfCorrectPassword($userPassword) {
        $users = $this->userCatalogue->getUsers();
        return in_array($userPassword, $users);
    }
    
    //Getters and setters for the private membervariables.
    
    public function getUserNameEmpty() {
        return $this->userNameEmpty;
    }
    
    public function getUserPasswordEmpty() {
        return $this->userPasswordEmpty;
    }
    
    public function getIsLoggedIn() {
        if($this->isAlreadyLoggedIn) {
            return true;
        }
        else {
            return $this->isLoggedIn;
        }
    }
    
    public function getIsAlreadyLoggedIn() {
        return $this->isAlreadyLoggedIn;
    }
    
    public function getIsLoggedOut() {
        return $this->isLoggedOut;
    }
}