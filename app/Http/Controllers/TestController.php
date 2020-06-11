<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\EloquentRepositoryInterface;
use App\Article;
class TestController extends Controller
{

     private $articleRepository;
     public function __construct(EloquentRepositoryInterface $articleRepository){
           $this->articleRepository = $articleRepository;
    }

    public function index(){
           $articles = $this->articleRepository->search((string) request('q'));

    return view('articles.index', [
        'articles' => $articles,
    ]);

    }
     public function test(){
         return Article::cursor();
        //    $articles = $this->articleRepository->searchItems((string) request('q'));
        //    return $articles;
    }

    public function destroy($id){
        return Article::find($id)->delete();
    }
}
