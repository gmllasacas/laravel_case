<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\ShortenedUrl;
use App\Http\Resources\ShortenedUrlCollection;
use App\Http\Traits\Helper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreShortenerRequest;
use App\Repositories\ShortenerRepository;

class ShortenerController extends Controller
{
    use Helper;

    /**
     * @var ShortenerRepository
     */
    protected $shortener_repository;

    /**
     * ShortenerController constructor.
     *
     * @param ShortenerRepository $shortener_repository
     */
    public function __construct(ShortenerRepository $shortener_repository)
    {
        $this->shortener_repository = $shortener_repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShortenerRequest  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function store(StoreShortenerRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $data = $this->shortener_repository->create($validated);

            return $this->onSuccess(
                $data['route'],
                $data['message']
            );
        } catch (\Throwable $e) {
            return $this->onError(500, $e->getMessage());
        }
    }

    /**
     * Get a specified resource.
     *
     * @param  string  $route
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function get($route)
    {
        try {
            $data = $this->shortener_repository->get($route);

            return redirect($data['url']);
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    /**
     * List of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $shortenedUrls = ShortenedUrl::orderBy('hits', 'desc')->take(100)->get();

            return (new ShortenedUrlCollection($shortenedUrls))->response()->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->onError(500, $e->getMessage());
        }
    }
}
