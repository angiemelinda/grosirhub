<?php

namespace App\Http\Controllers;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('admin.super_admin');
    }
}