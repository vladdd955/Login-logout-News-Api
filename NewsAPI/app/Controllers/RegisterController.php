<?php


namespace App\Controllers;


use App\Navigation;
use App\Services\RegisterService;
use App\Services\RegisterServiceRequest;
use App\Template;

class RegisterController
{
    public function showForm(): Template
    {
        return new Template("register.twig");
    }

    public function store()
    {
        if($_POST['password'] === $_POST['rePassword']) {
            $registerService = new RegisterService();
            $registerService->execute(
                new RegisterServiceRequest(
                    $_POST['name'],
                    $_POST['email'],
                    password_hash($_POST['password'], PASSWORD_DEFAULT)


                )
            );

        } else {
            return new Navigation("/register");
        }
        return new Navigation("/authorization",);
    }
}
