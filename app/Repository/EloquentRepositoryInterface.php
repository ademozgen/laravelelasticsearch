<?php
namespace App\Repository;



use Illuminate\Database\Eloquent\Collection;


interface EloquentRepositoryInterface
{

   public function search(string $query = ''): Collection;

}
