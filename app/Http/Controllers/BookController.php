<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\BookAuthor;
use App\BookCategory;
use App\BookPublisher;
use App\Category;
use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $books = Book::latest()->paginate(5);
        return view('admin.book.index',compact('books', 'user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $authors = Author::all()->toArray();
        $publishers = Publisher::all()->toArray();
        $categories = Category::all()->toArray();

        if ($user) {
            return view('admin.book.create', compact('user', 'publishers', 'authors', 'categories'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $book = Book::findOrFail($id);
        if ($user) {
            return view('admin.book.edit', compact('user', 'book'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50'
        ]);

        $user = Auth::user();
        $book = Book::findOrFail($id);
        if ($user) {
            $data = $request->all();

            $book->update([
                'name' => $data["name"]
            ]);

            return redirect()->route('book.index')
                ->with('success','Book created successfully.');
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required|min:3|max:50',
            'publisher_year' => 'required|numeric',
            'publisher' => 'required|numeric',
            'author' => 'required|numeric',
            'quantity' => 'required|numeric',
            'categories' => 'required|array',
            'attachment' => 'required|max:5024|mimes:jpg,jpeg,png',
        ]);

        $user = Auth::user();
        if ($user) {

            $file = $request->file('attachment');
            $tujuan_upload = 'public/attachments/cover';
            $random_id = Str::uuid()->toString();
            $filename = $random_id . "." . $file->getClientOriginalExtension();
            $file->storeAs($tujuan_upload, $filename);


            $book = Book::create([
                'title' => $data["name"],
                'published_year' => $data["publisher_year"],
                'quantity' => $data["quantity"],
                'publisher' => $data["publisher"],
                'thumbnail' => $filename
            ]);

            BookPublisher::create([
                'book_id' => $book->id,
                'publisher_id' => $data["publisher"],
            ]);

            BookAuthor::create([
                'book_id' => $book->id,
                'author_id' => $data["author"],
            ]);

            $categories = $request->input('categories');

            foreach($categories as $category) {
                BookCategory::create([
                    'book_id' => $book->id,
                    'category_id' => $category,
                ]);
            }

            return redirect()->route('books.index')
                ->with('success','Book created successfully.');
        } else {
            return redirect('/');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user) {
            $book = Book::findOrFail($id);

            if ($user->role == 'user') {
                abort(403);
            }

            return view('admin.book.show',compact('book', 'user'));
        } else {
            return redirect('/');
        }
    }


    public function destroy($id)
    {
        $books = Book::findOrFail($id);
        $books->delete();

        $category = BookCategory::where('id', $id)->delete();
        $author = BookAuthor::where('id', $id)->delete();
        $publisher = BookPublisher::where('id', $id)->delete();

        return redirect()->route('books.index')
            ->with('success','Book deleted successfully');
    }
}
