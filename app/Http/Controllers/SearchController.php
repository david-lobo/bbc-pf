<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function index(SearchService $search)
    {
        return ['results' => $search->filter()];
    }
}
