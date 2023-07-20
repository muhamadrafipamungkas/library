<?php

namespace App\Http\Controllers;

use App\Category;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::latest()->paginate(5);
        return view('admin.author.index',compact('authors'))
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
        $author = Author::all()->toArray();
        if ($user) {
            return view('admin.author.create', compact('user', 'author'));
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
        $author = Author::findOrFail($id);
        if ($user) {
            return view('admin.author.edit', compact('user', 'author'));
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
            'author_name' => 'required|min:3|max:50'
        ]);

        $user = Auth::user();
        $author = Author::findOrFail($id);
        if ($user) {
            $data = $request->all();

            $author->update([
                'author_name' => $data["author_name"]
            ]);

            return redirect()->route('authors.index')
                ->with('success','Author updated successfully.');
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
        $request->validate([
            'author_name' => 'required|min:3|max:50'
        ]);

        $user = Auth::user();
        if ($user) {

            $data = $request->all();

            Author::create([
                'author_name' => $data["author_name"]
            ]);

            return redirect()->route('authors.index')
                ->with('success','Author created successfully.');
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
            $author = Author::findOrFail($id);

            if ($user->role == 'user') {
                abort(403);
            }

            return view('admin.author.show',compact('author', 'user'));
        } else {
            return redirect('/');
        }
    }


    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')
            ->with('success','Author deleted successfully');
    }
}
