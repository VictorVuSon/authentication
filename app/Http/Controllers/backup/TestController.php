<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function doLogout() {
        \Auth::logout(); // log the user out of our application
        return \Redirect::to('/login'); // redirect the user to the login screen
    }
}
