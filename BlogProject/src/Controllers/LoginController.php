<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;



class LoginController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $this->render('login\index', []);
    }
}
