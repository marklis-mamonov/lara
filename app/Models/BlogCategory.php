<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
  use SoftDeletes;
  
  const ROOT = 1;
  
  protected $fillable = [
    'title',
    'slug',
    'parent_id',
    'description'
  ];

  /**
   * Получить родительскую категорию
     * @return BlogCategory
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Пример аксессуара
     * 
     * @return string
     */
    public function getParentTitleAttribute()
    {
      $title = $this->parentCategory->title
        ?? ($this->isRoot()
        ? 'Корень'
        : '???');
        return $title;
    }

    /**
     * Является ли текущий объект корневым
     * 
     * @return bool
     */
    public function isRoot()
    {
        return $this->id === BlogCategory::ROOT;
    }

    /**
     * Пример аксессуара
     * 
     * @return string $valueFromDB
     */
    public function getTitleAttribute($valueFromObject)
    {
      return mb_strtoupper($valueFromObject);
    }

    /**
     * Пример мутатора
     * 
     * @return string $valueFromDB
     */
    public function setTitleAttribute($incomingValue)
    {
      $this->attributes['title'] = mb_strtolower($incomingValue);
    }
}
