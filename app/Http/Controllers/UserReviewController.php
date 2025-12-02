<?php

namespace App\Http\Controllers;

use Psy\Util\Str;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserReviewController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        $reviews = Review::with('book')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc');

        if (!empty($request->keyword)) {
            $reviews = $reviews->where('review', 'like', '%' . $request->keyword . '%');
        }

        $reviews = $reviews->paginate(5);

        return view('account.user-review.list', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id) {}

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::with('book')->where(['id' => $id, 'user_id' => Auth::user()->id])
            ->firstOrFail();

        return view('account.user-review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = Review::where(['id' => $id, 'user_id' => Auth::user()->id])->firstOrFail();

        $validator = Validator::make($request->all(), [
            'review' => 'required|min:10',
            'rating' => 'required|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user-reviews.edit', $id)->withInput()->withErrors($validator);
        }

        $review = Review::where(['id' => $id, 'user_id' => Auth::user()->id])->firstOrFail();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->route('user-reviews.index')->with('success', 'Review Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::where(['id' => $id, 'user_id' => Auth::user()->id])->firstOrFail();

        if (!$review) {
            session()->flash('error', 'Review not found.');
            return redirect()->route('user-reviews.index');
        } else {
            $review->delete();
            session()->flash('success', 'Review deleted successfully.');
            return redirect()->route('user-reviews.index');
        }
    }
}
