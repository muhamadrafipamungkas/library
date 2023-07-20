<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $fillable = ["title", "author_id", "published_year", "publisher_id", "quantity", "thumbnail"];

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
            "book_id",
            "id",
            "id",
            "publisher_id"
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


    public function authors()
    {
        return $this->hasManyThrough(
            Author::class,
            BookAuthor::class,
            "book_id",
            "id",
            "id",
            "author_id"
        );
    }


    public function authors_name_list()
    {
        $authors_array = [];
        $authors = $this->hasManyThrough(
            Author::class,
            BookAuthor::class,
            "book_id",
            "id",
            "id",
            "author_id"
        )->get()->toArray();

        foreach ($authors as $author) {
            array_push($authors_array, $author["author_name"]);
        }

        return implode(',',$authors_array);
    }

    public function categories_id_list()
    {
        $cats_array = [];
        $cats = $this->hasManyThrough(
            Category::class,
            BookCategory::class,
            "book_id",
            "id",
            "id",
            "category_id"
        )->get()->toArray();

        foreach ($cats as $cat) {
            array_push($cats_array, $cat["id"]);
        }

        return implode(',',$cats_array);
    }

    public function categories_name_list()
    {
        $cats_array = [];
        $cats = $this->hasManyThrough(
            Category::class,
            BookCategory::class,
            "book_id",
            "id",
            "id",
            "category_id"
        )->get()->toArray();

        foreach ($cats as $cat) {
            array_push($cats_array, $cat["name"]);
        }
        return implode(',',$cats_array);
    }
}
