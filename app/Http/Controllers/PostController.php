<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $items = json_decode($response->getBody(), $assoc=true);
        $out = array();

        foreach ($items['items'] as $key => $item) {
            // Cull data so we don't have a massive table
            $tags = implode($item['tags'], ", ");
            $out[] = array(
                'tags' => $tags,
                'view_count' => $item['view_count'],
                'answer_count' => $item['answer_count'],
                'score' => $item['score'],
                'last_activity_date' => Carbon::createFromTimestamp($item['last_activity_date'])->toDateTimeString(),
                'creation_date' => Carbon::createFromTimestamp($item['creation_date'])->toDateTimeString(),
                'link' => $item['link'],
                'title' => $item['title'],
                'reputation' => $item['owner']['reputation'],
                'display_name' => $item['owner']['display_name'],
                'user_link' => $item['owner']['link'],
                'user_image' => $item['owner']['profile_image']
            );
        }

        return response()->json($out, 200, array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
