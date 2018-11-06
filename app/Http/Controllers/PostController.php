<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\JsonApi\Items\Schema as Items;

class PostController extends Controller
{
    public function index()
    {

        // /https://api.stackexchange.com/2.2/questions?page=1&pagesize=10&fromdate=1538352000&order=desc&sort=hot&site=stackoverflow

        $client = json_api('stackoverflow')->client();
        $response = $client->query('questions', [
            'page' => '1',
            'pagesize' => '10',
            'fromdate' => '1538352000',
            'order' => 'desc',
            'sort' => 'hot',
            'site' => 'stackoverflow',
        ]);

        $items = $response->getBody();
        $out = array();

        foreach ($items as $item) {
            // Cull data so we don't have a massive table
            $out[]= array(
                'is_answered' => $item->is_answered,
                'view_count' => $item->view_count,
                'answer_count' => $item->answer_count,
                'score' => $item->score,
                'last_activity_date' => $item->last_activity_date->toW3cString(),
                'creation_date' => $item->creation_date->toW3cString(),
                'link' => $item->link,
                'title' => $item->title,
                'reputation' => $item->owner->reputation,
                'display_name' => $item->owner->display_name,
                'user_link' => $item->owner->link,
            );

        }
        return $itemSchema->getAttributes($items);
    }
}
