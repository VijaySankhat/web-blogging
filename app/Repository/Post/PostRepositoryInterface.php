<?php
/**
 * Created by PhpStorm.
 * User: UNISOFT INFOTECH
 * Date: 10/6/2021
 * Time: 3:07 PM
 */

namespace App\Repository\Post;


use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function all(?string $order, ?string $search): LengthAwarePaginator;
}