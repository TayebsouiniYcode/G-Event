<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testMethod() {
        return "this is test method inside controller";
    }
}
