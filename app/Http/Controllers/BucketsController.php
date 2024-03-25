<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket; // Make sure to import the Bucket model at the top

class BucketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Assuming you don't have 'created_at' for 'latest()' to function.
        // Just paginate the results.
        $buckets = Bucket::paginate(10);

        return view('buckets.index', compact('buckets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buckets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Here you may apply validation if necessary
        Bucket::create($request->all());
        return redirect()->route('buckets.index')->with('success', 'Bucket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bucket $bucket)
    {
        return view('buckets.show', compact('bucket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bucket $bucket)
    {
        return view('buckets.edit', compact('bucket'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bucket $bucket)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'vendor' => 'required|string|max:255',
        ]);

        $bucket->update($request->all());

        return redirect()->route('buckets.index')->with('success', 'Bucket updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bucket $bucket)
    {
        $bucket->delete();
        return redirect()->route('buckets.index')->with('success', 'Bucket deleted successfully.');
    }

}
