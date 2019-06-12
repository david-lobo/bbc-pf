<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class ProgrammeController extends Controller
{
    /**
     * Show the programme index page
     *
     * @param  SearchService  $search
     * @param  Request  $request
     * @return View
     */
    public function index(SearchService $search, Request $request)
    {
        $term = $request->input('search', '');
        $appId = 'staticApp';
        $isSPA = empty($term);
        $data = [];

        if ($isSPA) {
            $appId = 'app';
        } else {
            $data['results'] = $search->filter($term);
        }

        $data['page_id'] = $appId;
        $data['is_spa'] = $isSPA;

        return view('programme.index', $data);
    }
}
