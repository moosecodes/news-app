<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NewsController extends Controller
{
    private mixed $newsDataResponse = [];
    private mixed $newsApiResponse = [];
    public function fetch() {
        $this->queryNewsSources();

        $latestHeadline = NewsArticle::latest('created_at')->first();
        if(isset($latestHeadline)) {
            $latestTimestamp = $latestHeadline->created_at;
            if (Carbon::parse($latestTimestamp)->lte(Carbon::now()->subHour())) {
                $this->queryNewsSources();
            }
        } else {
            $this->queryNewsSources();
        }

        return response('fetched news from sources!', 200);
    }

    private function queryNewsSources()
    {
        $this->newsapi_top_headlines();
        $this->newsdata_api_latest();
    }
    private function newsdata_api_latest()
    {
        $this->newsDataResponse = Http::get(env('NEWSDATA_API_URL'), [
            'apikey' => env('NEWSDATA_API_KEY'),
            'country' => 'us',
            'category' => 'sports,health',
            'language' => 'en',
        ]);

        $articles = $this->newsDataResponse['results'];

        for ($x = 0; $x < count($articles); $x++) {
            if (
                isset($articles[$x]['title']) &&
                isset($articles[$x]['link']) &&
                !NewsArticle::where('title', $articles[$x]['title'])->exists()
            ) {
                $article = new NewsArticle;
                $article->api_source = 'newsdata.io';

                $article->source_id = $articles[$x]['source_id'];
                $article->title = $articles[$x]['title'];
                $article->link = $articles[$x]['link'];
                $article->description = $articles[$x]['description'];
                $article->content = $articles[$x]['content'];
                $article->publishedAt = $articles[$x]['pubDate'];

                $article->image_url = $articles[$x]['image_url'];
                $article->language = $articles[$x]['language'];

                $article->save();
            }
        }
    }
    private function newsapi_top_headlines()
    {
        try {
            $this->newsApiResponse = Http::get('https://newsapi.org/v2/top-headlines', [
                'country' => 'us',
                'apiKey' => env('NEWSAPI_ORG_KEY')
            ]);
            $articles = $this->newsApiResponse->json()['articles'];

            for($x = 0; $x < count($articles); $x++) {
                if (
                    isset($articles[$x]['author']) &&
                    isset($articles[$x]['content']) &&
                    !NewsArticle::where('title', $articles[$x]['title'])->exists()
                ) {
                    $article = new NewsArticle;
                    $article->api_source = 'newsapi.org';

                    $article->source_id = $articles[$x]['source']['name'];
                    $article->title = $articles[$x]['title'];
                    $article->link = $articles[$x]['url'];
                    $article->description = $articles[$x]['description'];
                    $article->content = $articles[$x]['content'];
                    $article->publishedAt = $articles[$x]['publishedAt'];

                    $article->author = $articles[$x]['author'];
                    $article->image_url = $articles[$x]['urlToImage'];
                    $article->save();
                }
            }

        } catch(\Exception $e) {
            dd($e);
        }
    }
}
