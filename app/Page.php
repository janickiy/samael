<?php

namespace App;

use App\BaseModel;
use Illuminate\Support\Str;

class Page extends BaseModel
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $dates = ['published_at'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePage($query)
    {
        return $query->where('blog_post', 0);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePost($query)
    {
        return $query->where('blog_post', 1)->orderBy('published_at', 'desc');
    }

    /**
     * @return string
     */
    public function getPublishedAttribute()
    {
        return $this->attributes['published'] ? 'публикован' : 'не опубликован';
    }

    /**
     * @return string
     */
    public function getBlogPostAttribute()
    {
        return $this->attributes['blog_post'] ? 'Blog Post' : 'Page';
    }

    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return ($this->attributes['blog_post'] ? 'news/' : 'page/') . $this->attributes['slug'];
    }

    /**
     * @return string
     */
    public function excerpt()
    {
		$content = preg_replace("/<img(.*?)>/si", "", $this->content);
		$content = preg_replace('/(<.*?>)|(&.*?;)/', '', $content)  ;

        return Str::words($content,30);
    }
}
