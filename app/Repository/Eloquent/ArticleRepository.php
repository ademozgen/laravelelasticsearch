<?php

namespace App\Repository\Eloquent;

use App\Article;
use App\Repository\ArticleRepositoryInterface;
use Illuminate\Support\Collection;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
   public function __construct(Article $model)
   {
       parent::__construct($model);
   }

}
