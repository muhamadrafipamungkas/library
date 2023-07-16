<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookPublisher extends Model
{

    use SoftDeletes;
    protected $fillable = ["book_id", "publisher_id"];

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

    public function Publisher()
    {
        return $this->hasMany(
            Publisher::class,
            "id",
            "publisher_id"
        );
    }
}
