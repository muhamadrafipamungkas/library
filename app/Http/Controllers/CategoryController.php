<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index',compact('categories'))
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
        $category = Category::all()->toArray();
        if ($user) {
            return view('admin.category.create', compact('user', 'category'));
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
        $category = Category::findOrFail($id);
        if ($user) {
            return view('admin.category.edit', compact('user', 'category'));
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
        $category = Category::findOrFail($id);
        if ($user) {
            $data = $request->all();

            $category->update([
                'name' => $data["name"]
            ]);

            return redirect()->route('categories.index')
                ->with('success','Category updated successfully.');
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
            'name' => 'required|min:3|max:50'
        ]);

        $user = Auth::user();
        if ($user) {

            $data = $request->all();

            Category::create([
                'name' => $data["name"]
            ]);

            return redirect()->route('categories.index')
                ->with('success','Category created successfully.');
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
            $category = Category::findOrFail($id);

            if ($user->role == 'user') {
                abort(403);
            }

            return view('admin.category.show',compact('category', 'user'));
        } else {
            return redirect('/');
        }
    }


    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('categories.index')
            ->with('success','Category deleted successfully');
    }
}
