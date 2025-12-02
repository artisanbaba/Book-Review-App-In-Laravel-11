@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Edit Review
                    </div>
                    <div class="card-body pb-0"> 
                    <form action="{{ route('user-reviews.update', $review->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="card-body">
                            <div class="mb-3">                                
                                <label for="book" class="form-label ">Book Name</label>
                               <div class="bg bg-secondary text-white p-2"># {{ $review->book->title }}</div>
                            </div>

                            <div class="mb-3">                                
                                <label for="review" class="form-label">Review</label>
                                <textarea name="review" id="review" rows="5" placeholder="Review" class="form-control @error('review') is-invalid @enderror">{{ old('review', $review->review) }}</textarea>
                                @error('review')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5</option>
                                </select>
                            </div> 
                             
                            <button class="btn btn-primary mt-2">Update</button>                     
                        </div>
                    </form>
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>
@endsection