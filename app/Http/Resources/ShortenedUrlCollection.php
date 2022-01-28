<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShortenedUrlCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => array_map(function ($shortenedUrl) {
                return [
                    'id' => $shortenedUrl->id,
                    'route' => url('/shorted/' . $shortenedUrl->route),
                    'url' => $shortenedUrl->url,
                    'title' => $shortenedUrl->title,
                    'hits' => $shortenedUrl->hits,
                    'created_at' => $shortenedUrl->created_at->format('d/m/Y'),
                    'updated_at' => $shortenedUrl->updated_at->format('d/m/Y'),
                ];
            }, $this->all())
        ];
    }
}
