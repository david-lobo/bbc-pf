<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SearchService {

    protected $term;

    public function filter($term = '') 
    {
        $this->term = $term;
        $contents = Storage::get('source-data.json');
        $contents = json_decode($contents);
        $titles = $contents->atoz->tleo_titles;

        if (!empty($this->term)) {
            $titles = array_filter($titles, [$this, 'filterTitle']);
        }
        $items = array_map([$this, 'formatItem'], $titles);
        
        return array_values($items);
    }

    public function filterTitle($item)
    {   
        if (!empty($item->title) && !empty($this->term)) {
            $hit = strpos(strtolower($item->title), strtolower($this->term));
            if ($hit !== false) {
                return $item;
            }
        } 
        return false;
    }

    public function formatItem($item)
    {  
        $url = env('ICHEF_IMAGE_URL', '');
        $newItem = [];
        $newItem['pid'] = $item->programme->pid;
        $newItem['title'] = $item->programme->title;
        $newItem['is_available'] = $item->programme->is_available;
        $newItem['short_synopsis'] = $item->programme->short_synopsis;
        $newItem['image_pid'] = '';
        $newItem['image_url'] = env('PLACEHOLDER_IMAGE_URL', '');

        if (isset($item->programme->image)) {
            $newItem['image_pid'] = $item->programme->image->pid;
            $newItem['image_url'] = "{$url}{$item->programme->image->pid}.jpg";
        }

        return $newItem;
    }
}