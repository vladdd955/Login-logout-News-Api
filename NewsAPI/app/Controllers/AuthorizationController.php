<?php


namespace App\Controllers;


use App\Navigation;
use App\Template;


class AuthorizationController
{

    public function authorizationShow(): Template
    {
        return new Template("authorization.twig");
    }

    public function store()
    {

//        $_SESSION['user'] = $userName;


        if(empty($userEmail)){
            return new Navigation("/authorization") ;
        }


        return new Navigation("/");
    }








}