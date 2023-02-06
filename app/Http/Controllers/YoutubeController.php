<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Http\DTO\ParserResponse;
use Exception;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index()
    {
        $videos = [];
        $showList = false;

        return view("index", compact("videos", "showList"));
    }

    public function search(Request $request)
    {
        $showList = true;

        try {
            $query = $request->input("search");
            // Same params as before
            $params = [
                'q' => $query,
                'type' => 'video',
                'part' => 'id, snippet',
                'maxResults' => 10
            ];

            // An array to store page tokens so we can go back and forth
            $pageTokens = [];

            // Make inital search
            $videos = Youtube::paginateResults($params, null);
            $videos = ParserResponse::parser($videos['results']);

            return view("partials/_videos", compact("videos", "showList"));
        } catch (Exception $e) {
            $videos = [];
            $errorConnection = true;

            return view("partials/_videos", compact("videos", "showList", "errorConnection"));
        }
    }
}
