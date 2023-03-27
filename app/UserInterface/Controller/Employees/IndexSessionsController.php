<?php

namespace App\UserInterface\Controller\Employees;

use App\Infrastructure\Laravel\Controller;
use Illuminate\Http\Request;

class IndexSessionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('sessions');
    }
}
