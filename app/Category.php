<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    protected $fillable = ["name"];

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
        return $this->hasManyThrough(
            Book::class,
            BookCategory::class,
            "category_id",
            "book_id"
        );
    }
}
