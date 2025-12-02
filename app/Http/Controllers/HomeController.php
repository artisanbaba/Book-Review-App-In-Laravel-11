<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    // Home Page
    public function index(Request $request)
    {

        $books = Book::withCount('reviews')->withSum('reviews', 'rating')->orderBy('created_at', 'desc');

        if (!empty($request->keyword)) {
            $books->where('title', 'like', '%' . $request->keyword . '%');
        }

        $books = $books->where('status', 1)->paginate(8);

        // dd($books);

        return view('home', ['books' => $books]);
    }

    // Book Detail Page
    public function bookDetail($id)
    {

        $book = Book::with(['reviews.user', 'reviews' => function ($query) {
            $query->where('status', 1);
        }])->withCount('reviews')
            ->withSum('reviews', 'rating')
            ->findOrFail($id);

        // dd($book);

        if ($book->status == 0) {
            abort(404);
        }

        $relatedBooks = Book::where('status', 1)
            ->withCount('reviews')
            ->withSum('reviews', 'rating')
            ->take(3)
            ->where('id', '!=', $id)
            ->inRandomOrder()->get();

        return view('book-detail', ['book' => $book, 'relatedBooks' => $relatedBooks]);
    }

    // Save Book Review
    public function saveReview(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($validated->fails()) {
            return response()->json(
                [
                    'status' => 'false',
                    'errors' => $validated->errors(),
                ]
            );
        }

        // count user review for the book and prevent multiple reviews
        $existingReview = Review::where('book_id', $request->book_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($existingReview) {
            session()->flash('error', 'You have already submitted a review for this book.');

            return response()->json([
                'status' => 'success',
            ]);
        }

        $review = new Review();
        $review->book_id = $request->book_id;
        $review->user_id = Auth::user()->id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        session()->flash('success', 'Review submitted successfully.');

        return response()->json(['status' => 'success']);
    }
}
