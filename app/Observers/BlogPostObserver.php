<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{

    /**
     * Отработка ПЕРЕД созданием записи
     *
     * @param BlogPost $blogPost
     */

    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);

        $this->setSlug();


    }

    /**
     * Отработка ПЕРЕД обновлением записи
     *
     * @param BlogPost $blogPost
     */

    public function updating(BlogPost $blogPost){
//        $test[] = $blogPost->isDirty(); //Проверка на изменение всех полей модели
//        $test[] = $blogPost->isDirty('is_published'); //Проверка на изменение одного поля модели
//        $test[] = $blogPost->isDirty('user_id');
//        $test[] = $blogPost->getAttribute('is_published'); //Получить ИЗМЕНЕННОЕ значение поля 1 способ
//        $test[] = $blogPost->is_published;                      //Получить ИЗМЕНЕННОЕ значение поля 2 способ
//        $test[] = $blogPost->getOriginal('is_published');  //Получить СТАРОЕ значение поля 2 способ
//        dd($test);

        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);

    }

    /**
     * Если дата публикации не установлена и происходит установка флага - Опубликовано,
     * то устанавливаем дату пубикации на текущую.
     *
     * @param BlogPost $blogPost
     */

    protected function setPublishedAt(BlogPost $blogPost)
    {
        if(empty($blogPost->published_at) && $blogPost->is_published){
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если поле слаг пустое, то заполяем его конвертацией заголовка.
     *
     * @param BlogPost $blogPost
     */

    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }



    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
