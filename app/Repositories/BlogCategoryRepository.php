<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
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

    /**
     * Получить список категорий для вывода в выпадающем списке
     *
     * @return Collection
     *
     */

    public function getForComboBox()
    {

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ", ", title) AS id_title'
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns) //Сырой запрос к БД используя SQL-функции
            ->toBase() // Взять только данные запроса, а не данные всей модели
            ->get(); // Выполнить запрос

        return $result;
    }


    /**
     * Получить все записи с пагинацией
     *
     * @param int $perPage
     *
     * @return Collection
     *
     */

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }


}


?>