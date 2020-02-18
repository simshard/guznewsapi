<?php


namespace App\Http\Controllers;


use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param NewsService $newsService
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,NewsService $newsService)
    {
         $headlines= $newsService->headlines();
        return $headlines;
    }

}
