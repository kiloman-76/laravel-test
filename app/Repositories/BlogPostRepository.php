<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * Получить список статей для вывода в списке
     * (Админка)
     *
     * @return LengthAwarePaginator
     */

    public function getAllWithPaginate($perPage = null)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',      //Если используются связанные модели, то поля,
            'category_id',  //по которым идет связь, должны идти в запросе
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            /*Заранее собираем все нужные данные одним запросом,
             чтобы не подгружать связанные данные для каждого элемента циклом */
            ->with([
                //Загружать связанные данные можно так
                'category' => function ($query){
                    $query->select(['id', 'title']); //Можно добавить дополнительные условия
                },
                //Или так
                'user:id,name' // Оставляем только те поля, которые нам нужны
            ])
            ->paginate(25);

        return $result;
    }
    /**
     * Получить модель для редактирования в админке
     *
     * @param int $id
     *
     * @return Model
     *
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}


?>