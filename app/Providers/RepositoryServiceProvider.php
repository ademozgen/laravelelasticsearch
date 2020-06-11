<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;

use App\Repository\ArticleRepositoryInterface;
use App\Repository\Eloquent\ArticleRepository;
use App\Repository\Eloquent\ElasticsearchRepository;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);

        $this->app->bind(EloquentRepositoryInterface::class, function ($app) {
            if (! config('services.search.enabled')) {
                return new BaseRepository();
            }
            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });
        $this->bindSearchClient();
    }

      private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
