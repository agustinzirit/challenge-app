<?php

namespace App\Http\DTO;

class ParserResponse
{
    public static function parser($result)
    {
        if ($result) {
            $response = collect($result)->map(function ($item, $key) {
                return (object)[
                    "published_at" => $item->snippet->publishedAt,
                    "id" => $item->id->videoId,
                    "title" => $item->snippet->title,
                    "description" => $item->snippet->description,
                    "thumbnail" => $item->snippet->thumbnails->medium->url,
                    "extra" => (object)[
                        "width" => $item->snippet->thumbnails->medium->width,
                        "height" => $item->snippet->thumbnails->medium->height,
                    ]
                ];
            })->toArray();
        } else {
            $response = (object)[];
        }

        return (object)$response;
    }
}
