<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCategory extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     *
     * Get the suggestions for the category.
     */
    public function books()
    {
        return $this->hasMany(
            Book::class,
            "id",
            "book_id"
        );
    }

    public function categories()
    {
        return $this->hasMany(
            Category::class,
            "id",
            "category_id"
        );
    }
}
