<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __invoke(Request $request): Application|Factory|View
    {
        return view('welcome');
    }
}
