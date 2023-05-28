<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
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
    public function user()
    {
        return $this->hasOne(
            User::class,
            "id",
            "user_id"
        );
    }

    /**
     *
     * Get the suggestions for the category.
     */
    public function book()
    {
        return $this->hasOne(
            Book::class,
            "id",
            "book_id"
        );
    }

    /**
     *
     * Get the suggestions for the category.
     */
    public function borrow()
    {
        return $this->hasMany(
            Book::class,
            "id",
            "book_id"
        );
    }
}
