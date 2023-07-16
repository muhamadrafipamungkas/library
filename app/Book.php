<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $fillable = ["title", "author_id", "published_year", "publisher", "quantity", "thumbnail"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function publisher()
    {
        return $this->hasManyThrough(
            Publisher::class,
            BookPublisher::class,
            "publisher_id",
            "id"
        );
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class,
            BookCategory::class,
            "book_id",
            "id"
        );
    }
}
