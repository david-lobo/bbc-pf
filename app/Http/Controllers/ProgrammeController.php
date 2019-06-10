<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function index()
    {
        return view('programme.index', ['page_id' => 'app']);
    }
}
