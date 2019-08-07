<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogPostRepositories
 * 
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * Получить список статей (Админка)
     * 
     * @return LengthAwarePaginator
     */

public function getAllWithPaginate()
{
    $columns = [
        'id',
        'title',
        'slug',
        'is_published',
        'published_at',
        'user_id',
        'category_id'
    ];

    $result = $this->startConditions()
                   ->select($columns)
                   ->orderBy('id', 'DESC')
                   ->with(['category:id,title', 'user:id,name'])
                   ->paginate(25);
    
    return $result;
}

/**
 * Получить модель и редактировать в админке
 * 
 * @param ind $id
 * 
 * @return Model
 */
public function getEdit($id)
{
    return $this->startConditions()->find($id);
}

}