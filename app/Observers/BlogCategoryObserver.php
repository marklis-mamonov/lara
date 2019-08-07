<?php

namespace App\Observers;

use App\Models\BlogCategory;

class BlogCategoryObserver
{

    /**
     * Обработка ПЕРЕД созданием записи
     * 
     * 
     * @param  \App\Models\BlogCategory  $blogCategory
     */

    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Обработка ПЕРЕД созданием записи
     * 
     * 
     * @param  \App\Models\BlogCategory  $blogCategory
     */

    public function updating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }
    
    /**
     * Конвертация заголовка
     * 
     * 
     * @param BlogCategory $blogCategory
     */
    protected function setSlug(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)) {
            $blogCategory->slug = \Str::slug($blogCategory->title);
        }
    }
    /**
     * Handle the category post "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the category post "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the category post "deleted" event.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the category post "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the category post "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
