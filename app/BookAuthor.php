<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAuthor extends Model
{
    use SoftDeletes;
    protected $fillable = ["book_id", "author_id"];

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

    public function authors()
    {
        return $this->hasMany(
            Author::class,
            "id",
            "author_id"
        );
    }
}
