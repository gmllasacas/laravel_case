<?php

namespace Tests\Feature;

use http\Client\Response;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Models\ShortenedUrl;

/**
 *
 * Run these specific tests
 * php artisan test tests/Feature/ShortenerControllerTest.php
 *
 * @package Tests\Feature\
 */
class ShortenerControllerTest extends TestApi
{
    /**
     * API endpoint
     */
    const ENDPOINT_AUTH = 'api/shortener';
    const WEB_ROUTE = '/shorted';

    /**
     * Return mock data for a new user creation
     *
     * @return array
     */
    private function getNewShortenedUrlMockData(): array
    {
        return [
            'id' => 1,
            'route' => 'd90b568f',
            'url' => 'https://www.bing.com/',
            'title' => null,
            'hits' => 100,
        ];
    }

    /**
     * @test
     *
     * @return void
     */
    public function register_a_new_shortened_url()
    {
        $new_data = [
            'url' => 'https://www.google.com/search?q=test&pws=0&gl=us&gws_rd=cr/',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->getToken())->json('POST', self::ENDPOINT_AUTH, $new_data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'URL shorten successfully');
    }

    /**
     * @test
     *
     * @return void
     */
    public function register_an_already_shortened_url()
    {
        $employee_mock = ShortenedUrl::create($this->getNewShortenedUrlMockData());

        $new_data = [
            'url' => 'https://www.bing.com/',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->getToken())->json('POST', self::ENDPOINT_AUTH, $new_data);

        $response->assertStatus(200);
        $response->assertJsonPath('message', 'URL already shorted');
    }

    /**
     * @test
     *
     * @return void
     */
    public function get_a_shortened_url_redirect()
    {
        $employee_mock = ShortenedUrl::create($this->getNewShortenedUrlMockData());

        $response = $this->get(self::WEB_ROUTE . '/d90b568f');

        $response->assertStatus(302);
    }

    /**
     * @test
     *
     * @return void
     */
    public function show_not_found_on_a_incorrect_shortened_url()
    {
        $employee_mock = ShortenedUrl::create($this->getNewShortenedUrlMockData());

        $response = $this->get(self::WEB_ROUTE . '/d90b0000');

        $response->assertStatus(404);
    }
}
