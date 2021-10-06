<?php
/**
 * Created by PhpStorm.
 * User: UNISOFT INFOTECH
 * Date: 10/6/2021
 * Time: 3:08 PM
 */

namespace App\Repository\Post;


use App\Models\Post;
use App\Repository\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(?string $order, ?string $search): LengthAwarePaginator
    {
        return $this->model->sorting($order)
            ->search($search)
            ->paginate(config('app.default_item_per_page'));
    }
}