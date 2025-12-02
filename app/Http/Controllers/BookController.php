<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::orderBy('created_at', 'desc');


        if (!empty($request->keyword)) {
            $books->where('title', 'like', '%' . $request->keyword . '%');
        }
        $books = $books->withCount('reviews')
            ->withSum('reviews', 'rating')->paginate(5);

        return view('account.books.list', ['books' => $books, 'user' => Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required',
        ];

        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('books.create')->withInput()->withErrors($validator);
        }

        // save book in DB 
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        // here upload image
        if (!empty($request->image)) {

            // delete old image
            File::delete(public_path('uploads/books/' . $book->book));
            File::delete(public_path('uploads/books/thumb/' . $book->book));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            $image->move(public_path('uploads/books'), $imageName);

            $book->image = $imageName;
            $book->save();

            // create new image instance
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/books/' . $imageName));

            $img->scale(200, 200);

            $img->save(public_path('uploads/books/thumb/' . $imageName));
        }

        return redirect()->route('books.index')->with('success', 'Book Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::withCount('reviews')
            ->withSum('reviews', 'rating')
            ->findOrFail($id);

        return view('account.books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return view('account.books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required',
        ];

        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('books.edit', $book->id)->withInput()->withErrors($validator);
        }

        // Update book in DB 
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->status = $request->status;
        $book->save();

        // here upload image
        if (!empty($request->image)) {

            // delete old image
            File::delete(public_path('uploads/books/' . $book->image));
            File::delete(public_path('uploads/books/thumb/' . $book->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            $image->move(public_path('uploads/books'), $imageName);

            $book->image = $imageName; // error likely here
            $book->save();

            // generate image thumbnail
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/books/' . $imageName));

            $img->scale(200, 200);

            $img->save(public_path('uploads/books/thumb/' . $imageName));
        }

        return redirect()->route('books.index')->with('success', 'Book Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if (!$book) {
            session()->flash('error', 'Book not found.');
            return redirect()->route('books.index');
        } else {
            $book->delete();

            File::delete(public_path('uploads/books/' . $book->image));
            File::delete(public_path('uploads/books/thumb/' . $book->image));


            // session()->flash('success', 'Book deleted successfully.');
            return redirect()->route('books.index')->with('success', 'Book Deleted Successfully!');
        }


        // if ($book == null) {
        //     session()->flash('error', 'Book not fond!');

        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Book not fond!'
        //     ]);
        // } else {
        //     // // delete old image
        //     File::delete(public_path('uploads/books/' . $book->image));
        //     File::delete(public_path('uploads/books/thumb/' . $book->image));

        //     $book->delete();

        //      session()->flash('success', 'Book deleted Successfully!');

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Book deleted Successfully',
        //     ]);
        // }
    }
}
