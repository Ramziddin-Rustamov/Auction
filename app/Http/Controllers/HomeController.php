<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
         * @OA\Get(
         *     path="/home",
         *     summary="Get current user",
         *     description="Returns information about the current user if the request is authenticated",
         *     @OA\Response(
         *         response=200,
         *         description="Everything OK"
         *     ),
         *     @OA\Response(
         *         response=403,
         *         description="Access Denied"
         *     )
         * )
    */
    public function index()
    {
        return view('home');
    }
}
