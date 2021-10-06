<?php
/**
 * Created by PhpStorm.
 * User: UNISOFT INFOTECH
 * Date: 10/6/2021
 * Time: 3:05 PM
 */

namespace App\Repository;


use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
}