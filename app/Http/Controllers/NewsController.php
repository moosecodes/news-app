<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NewsController extends Controller
{
    protected mixed $newsdataApiResponse = [];
    protected mixed $newsapiApiResponse = [];

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
    }
    private function queryNewsSources() {
        $this->newsapi_top_headlines();
        $this->newsdata_api_latest();
    }
    public function newsdata_api_latest()
    {
        // https://newsdata.io/documentation
        $this->newsdataApiResponse = Http::get(env('NEWSDATA_API_URL'), [
            'apikey' => env('NEWSDATA_API_KEY'),
            'country' => 'us',
//            'category' => 'sports,health',
            'language' => 'en',
        ]);

        $articles = $this->newsdataApiResponse['results'];

        for ($x = 0; $x < count($articles); $x++) {
            if (
                isset($articles[$x]['title']) &&
                isset($articles[$x]['link']) &&
                !NewsArticle::where('title', $articles[$x]['title'])->exists()
            ) {
                $article = new NewsArticle;
                $article->api_source = 'newsdata.io';

                $article->title = $articles[$x]['title'];
                $article->link = $articles[$x]['link'];
                $article->video_url = $articles[$x]['video_url'];
                $article->pubDate = $articles[$x]['pubDate'];
                $article->image_url = $articles[$x]['image_url'];
                $article->source_id = $articles[$x]['source_id'];
                $article->language = $articles[$x]['language'];
                $article->description = $articles[$x]['description'];
                $article->content = $articles[$x]['content'];

//                $article->keywords = implode(', ', $articles[$x]['keywords']);
//                $article->creator = implode(', ', $articles[$x]['creator']);
//                $article->category = implode(', ', $articles[$x]['category']);
//                $article->country = implode(', ', $articles[$x]['country']);

                $article->save();
            }
        }
    }
    public function newsapi_top_headlines()
    {
        try {
            $this->newsapiApiResponse = Http::get('https://newsapi.org/v2/top-headlines', [
                'country' => 'us',
                'apiKey' => env('NEWSAPI_ORG_KEY')
            ]);
            $articles = $this->newsapiApiResponse->json()['articles'];

            for($x = 0; $x < count($articles); $x++) {
                if (
                    isset($articles[$x]['author']) &&
                    isset($articles[$x]['content']) &&
                    ! NewsArticle::where('title', $articles[$x]['title'])->exists()
                ) {
                    $article = new NewsArticle;
                    $article->api_source = 'newsapi.org';
                    $article->source = $articles[$x]['source']['name'];
                    $article->author = $articles[$x]['author'];
                    $article->title = $articles[$x]['title'];
                    $article->description = $articles[$x]['description'];
                    $article->url = $articles[$x]['url'];
                    $article->urlToImage = $articles[$x]['urlToImage'];
                    $article->publishedAt = $articles[$x]['publishedAt'];
                    $article->content = $articles[$x]['content'];
                    $article->save();
                }
            }

        } catch(\Exception $e) {
            dd($e);
        }
    }
}
