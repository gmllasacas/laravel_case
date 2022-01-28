<?php

namespace App\Repositories;

use App\Models\ShortenedUrl;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Helper;
use Exception;

class ShortenerRepository
{
    use Helper;

    /**
     * @var ShortenedUrl
     */
    protected $model;

    /**
     * ShortenerRepository constructor.
     *
     * @param ShortenedUrl $shortenedUrl
     */
    public function __construct(ShortenedUrl $shortenedUrl)
    {
        $this->model = $shortenedUrl;
    }

    /**
     * Set a new shortenedUrl model into de model attribute
     *
     * @param ShortenedUrl $shortenedUrl
     */
    public function setShortener(ShortenedUrl $shortenedUrl)
    {
        $this->model = $shortenedUrl;
    }

    /**
     * Create a new employee
     *
     * @param array $data
     *
     * @return arrays
     *
     * @throws Exception
     */
    public function create(array $data): array
    {
        try {
            $shortenedUrl = ShortenedUrl::where('url', $data['url'])->first();
            if ($shortenedUrl) {
                return [
                    'message' => 'URL already shorted',
                    'route' => url('/shorted/' . $shortenedUrl->route)
                ];
            }

            $this->model->route = $this->uniqidReal();
            $this->model->url = $data['url'];
            $this->model->save();
            $this->model->refresh();

            return [
                'message' => 'URL shorten successfully',
                'route' => url('/shorted/' . $this->model->route)
            ];
        } catch (\Throwable $e) {
            $message = 'Failed to shorten URL, ' .
                'error: ' . $e->getMessage();

            throw new Exception($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $route
     */
    public function get($route)
    {
        try {
            $this->model = ShortenedUrl::where('route', $route)->first();
            if ($this->model) {
                $this->model->hits += 1;
                $this->model->save();
                $this->model->refresh();
                return [
                    'url' => $this->model->url
                ];
            } else {
                throw new Exception('The shorten URL does not exist');
            }
        } catch (\Throwable $e) {
            $message = 'Failed to get the original URL, ' .
                'error: ' . $e->getMessage();

            throw new Exception($message);
        }
    }
}
