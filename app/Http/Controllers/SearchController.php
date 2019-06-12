<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    /**
     * API list programmes with filter
     *
     * @param  SearchService  $search
     * @param  Request  $request
     * @return View
     */
    public function index(SearchService $search, Request $request)
    {
        $term = $request->input('search', '');
        return ['results' => $search->filter($term)];
    }
}
