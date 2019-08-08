<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{

    /**
     * Обработка ПЕРЕД созданием записи
     * 
     * 
     * @param  \App\Models\BlogPost  $blogPost
     */

    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }

    /**
     * Обработка ПЕРЕД созданием записи
     * 
     * 
     * @param  \App\Models\BlogPost  $blogPost
     */

    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }
    
    /**
     * Устанавливаем дату публикации
     * 
     * 
     * @param BlogPost $blogPost
     */
    protected function setPublishedAt(BlogPost $blogPost)
    {
        $needSetPublished = empty($blogPost->published_at) && $blogPost->is_published;
        if ($needSetPublished) {
            $blogPost->published_at = Carbon::now();
        }
    }
    
    /**
     * Конвертация заголовка
     * 
     * 
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)) {
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }

    /**
     * Установка значения полю content_html
     * 
     * @param BlogPost $blogPost
     */
    protected function setHtml(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')) {
            // TODO: Тут должна быть генерация markdown->html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    /**
     * Если не указан user_id, то устанавливаем по-умолчанию
     * 
     * @param BlogPost $blogPost
     */
    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
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
