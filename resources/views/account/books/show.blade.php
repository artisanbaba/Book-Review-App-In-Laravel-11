@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow">

                <div class="card-header text-white">
                    Book Details
                </div>

                @include('layouts.message')

                <div class="card-body">

                    {{-- Back button --}}
                    <a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">
                        <i class="fa fa-arrow-left"></i> Back to Books
                    </a>

                    {{-- Book information --}}
                    <div class="row">
                        <div class="col-md-8">

                            <h3>{{ $book->title }}</h3>
                            <p><strong>Author:</strong> {{ $book->author }}</p>

                            {{-- Rating --}}
                            @php
                                $ratingCount = $book->reviews_count;
                                $ratingSum = $book->reviews_sum_rating;

                                if ($ratingCount > 0) {
                                    $avgRating = $ratingSum / $ratingCount;
                                } else {
                                    $avgRating = 0;
                                }

                                $avgRatingPer = ($avgRating / 5) * 100;
                            @endphp

                            <p>
                                <strong>Rating:</strong> 
                                {{ number_format($avgRating, 1) }} / 5
                                ({{ $ratingCount }} {{ $ratingCount > 1 ? 'Reviews' : 'Review' }})
                            </p>

                            <p>
                                <strong>Status:</strong>
                                @if ($book->status == 1)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Blocked</span>
                                @endif
                            </p>

                            <hr>

                            <p><strong>Description:</strong></p>
                            <p style="text-align: justify;">{{ $book->description ?? 'No description available.' }}</p>

                        </div>

                        <div class="col-md-4 text-center">
                            {{-- Book Cover --}}
                            @if($book->image)
                                <img src="{{ asset('uploads/books/' . $book->image) }}" 
                                     class="img-fluid rounded shadow" 
                                     style="max-height: 250px; object-fit: cover;">
                            @else
                                     <img src="{{asset('uploads/books/placeholder.png')}}" alt="" class="img-fluid rounded shadow" 
                                     style="max-height: 250px;">
                            @endif
                        </div>

                    </div>

                    <hr>

                    {{-- Edit + Delete --}}
                    <div class="d-flex">

                        <a href="{{ route('books.edit', $book->id) }}" 
                           class="btn btn-primary me-2">
                           <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" 
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this book?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
