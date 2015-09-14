<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/UserModel.php');
require_once('model/LoginModel.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Creates an object of User.
$userModel = new UserModel('Patrik', 'Losenord');

//Creates an object of loginmodel.
$loginModel = new LoginModel($userModel);

//CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView($loginModel);
$dateTimeView = new DateTimeView();
$layoutView = new LayoutView();

$loginView->setRequestMessageId('');

//Creates an object of logincontroller.
$loginController = new LoginController($loginModel, $loginView);
$loginController->checkIfLogin();
$loginController->checkIfLogout();

$isLoggedIn = $loginModel->isLoggedIn();

$layoutView->render($isLoggedIn, $loginView, $dateTimeView);