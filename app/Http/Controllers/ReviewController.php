<?php

namespace App\Http\Controllers;

use Psy\Util\Str;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reviews = Review::with('book', 'user')->orderBy('created_at', 'desc');

        if (!empty($request->keyword)) {
            $reviews = $reviews->where('review', 'like', '%' . $request->keyword . '%');
        }

        $reviews = $reviews->paginate(10);

        return view('account.reviews.list', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $review = Review::findOrFail($id);

        return view('account.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $review = Review::findOrFail($id);

        $validatedData = Validator::make($request->all(), [
            'review' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        if ($validatedData->fails()) {
            return redirect()->route('reviews.edit', $id)
                ->withErrors($validatedData)
                ->withInput();
        }

        $review->review = $request->review;
        $review->status = $request->status;
        $review->save();

        session()->flash('success', 'Review updated successfully.');

        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $review = Review::findOrFail($id);

        if (!$review) {
            session()->flash('error', 'Review not found.');
            return redirect()->route('');
        } else {
            $review->delete();
            session()->flash('success', 'Review deleted successfully.');
            return redirect()->route('reviews.index');
        }
    }
}
