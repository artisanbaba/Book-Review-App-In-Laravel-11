@extends('layouts.app')

@section('main') 
<div class="container mt-3 ">
    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">
            <a href="{{ route('home') }}" class="text-decoration-none text-dark ">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Back to books</strong>
            </a>
            <div class="row mt-4">
                <div class="col-md-4">
                    @if ($book->image != '')
                        <img src="{{ asset('uploads/books/'.$book->image) }}" alt="" class="card-img-top"> 
                    @else
                        <img src="{{asset('images/default-placeholder.png')}}" alt="" class="img-fluid card-img-top">
                    @endif
                </div>
                <div class="col-md-8">
                    @include('layouts.message')

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

                    <h3 class="h2 mb-3">{{ $book->title }}</h3>
                    
                    <div class="h4 text-muted">{{ $book->author }}</div>
                    <div class="star-rating d-inline-flex ml-2" title="">
                        <span class="rating-text theme-font theme-yellow">{{ number_format($avgRating, 1) }}</span>
                        <div class="star-rating d-inline-flex mx-2" title="">
                            <div class="back-stars ">
                                <i class="fa fa-star " aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>

                                <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <span class="theme-font text-muted"><span class="theme-font text-muted">{{ ($ratingCount > 1) ? "($ratingCount Reviews)" : "($ratingCount Review)" }}</span></span>
                    </div>

                    <div class="content mt-3">
                        {{ $book->description }}
                    </div>

                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">Readers also enjoyed</h2>
                        </div> 
                        @if ($relatedBooks->isNotEmpty())
                            @foreach ($relatedBooks as $relatedBook)
                            <div class="col-md-4 col-lg-4 mb-4">
                                <div class="card border-0 shadow-lg">
                                    <a href="{{ route('book.detail', $relatedBook->id) }}">
                                        @if ($relatedBook->image != '')
                                            <img src="{{ asset('uploads/books/'.$relatedBook->image) }}" alt="" class="card-img-top"> 
                                        @else 
                                            <img src="{{asset('images/default-placeholder.png')}}" alt="" class="img-fluid card-img-top">
                                        @endif 
                                    </a>

                                    @php
                                        $relatedRatingCount = $relatedBook->reviews_count;
                                        $relatedRatingSum = $relatedBook->reviews_sum_rating;

                                        if ($relatedRatingCount > 0) {
                                            $relatedAvgRating = $relatedRatingSum / $relatedRatingCount;
                                        } else {
                                            $relatedAvgRating = 0;
                                        }

                                        $relatedAvgRatingPer = ($relatedAvgRating / 5) * 100;
                                    @endphp

                                    <div class="card-body">
                                        <h3 class="h4 heading">
                                            <a href="{{ route('book.detail', $relatedBook->id) }}">{{ $relatedBook->title }}</a>
                                        </h3>
                                        <p>by {{ $relatedBook->author }}</p>
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span class="rating-text theme-font theme-yellow">
                                                {{ number_format($relatedAvgRating, 1) }}
                                            </span>

                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars ">
                                                    <i class="fa fa-star " aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                
                                                    <div class="front-stars" style="width: {{ $relatedAvgRatingPer }}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="theme-font text-muted"><span class="theme-font text-muted">{{ ($relatedRatingCount > 1) ? "($relatedRatingCount Reviews)" : "($relatedRatingCount Review)" }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            @endforeach
                        @endif
                                                                 
                    </div>
                    <div class="col-md-12 pt-2">
                        <hr>
                    </div>
                    <div class="row pb-5">
                        <div class="col-md-12  mt-4">
                            <div class="d-flex justify-content-between">
                                <h3>Reviews</h3>
                                <div>
                                    @if (Auth::check())
                                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Review
                                      </button>  
                                    @else
                                        <a href="{{ route('account.login') }}" class="btn btn-primary">
                                            Login to Add Review
                                        </a>    
                                    @endif
                                </div>
                            </div>                        
                            @if ($book->reviews->isNotEmpty())
                                @foreach ($book->reviews as $review)
                                <div class="card border-0 shadow-lg my-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-3">{{ $review->user->name }}</h4>
                                            <span class="text-muted">{{ $review->created_at->format('d M, Y') }}</span>         
                                        </div>
                                        @php
                                            $reviewPresent = ($review->rating/5) * 100; // Convert rating to percentage for star width
                                        @endphp

                                        <div class="mb-3">
                                            <div class="star-rating d-inline-flex" title="">
                                                <div class="star-rating d-inline-flex " title="">
                                                    <div class="back-stars ">
                                                        <i class="fa fa-star " aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>

                                                        <div class="front-stars" style="width: {{ $reviewPresent }}%">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                                            
                                        </div>
                                        <div class="content">
                                            <p>{{ $review->review }}</p>
                                        </div>
                                    </div>
                                </div>         
                                @endforeach
                                @else
                                    <p class="text-muted">No reviews found for this book.</p>
                                @endif 
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>   

<!-- Modal -->
<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>Atomic Habits</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <form action="" id="bookReviewForm" name="bookReviewForm">
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div class="modal-body">                
                    <div class="mb-3">
                        <label for="" class="form-label">Review</label>
                        <textarea name="review" id="review" class="form-control" cols="5" rows="5" placeholder="Review"></textarea>
                        <p class="invalid-feedback" id="reviewError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#bookReviewForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '{{ route("book.saveReview") }}',
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response){
                if(response.status === 'success'){
                    // alert('Review submitted successfully!');
                    location.reload();
                } else {
                    let errors = response.errors;

                    if(errors.review){
                        $('#review').addClass('is-invalid');
                        $('#reviewError').text(errors.review[0]);
                    } else {
                        $('#review').removeClass('is-invalid');
                        $('#reviewError').text('');
                    }
                }
            },
            error: function(xhr){
                alert('An error occurred while submitting your review. Please try again.');
            }
        });
    });
</script>
@endpush
