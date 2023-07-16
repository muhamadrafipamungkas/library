<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::latest()->paginate(5);
        return view('admin.publisher.index',compact('publishers'))
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
        $publisher = Publisher::all()->toArray();
        if ($user) {
            return view('admin.publisher.create', compact('user', 'publisher'));
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
        $publisher = Publisher::findOrFail($id);
        if ($user) {
            return view('admin.publisher.edit', compact('user', 'publisher'));
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
        $publisher = Publisher::findOrFail($id);
        if ($user) {
            $data = $request->all();

            $publisher->update([
                'publisher_name' => $data["name"]
            ]);

            return redirect()->route('publishers.index')
                ->with('success','Publisher created successfully.');
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

            Publisher::create([
                'publisher_name' => $data["name"]
            ]);

            return redirect()->route('publishers.index')
                ->with('success','Publisher created successfully.');
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
            $publisher = Publisher::findOrFail($id);

            if ($user->role == 'user') {
                abort(403);
            }

            return view('admin.publisher.show',compact('publisher', 'user'));
        } else {
            return redirect('/');
        }
    }


    public function destroy($id)
    {
        $publishers = Publisher::findOrFail($id);
        $publishers->delete();

        return redirect()->route('publishers.index')
            ->with('success','Publisher deleted successfully');
    }
}
