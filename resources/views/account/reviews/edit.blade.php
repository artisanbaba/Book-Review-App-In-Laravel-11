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
                    <form action="{{ route('reviews.update', $review->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="card-body">
                            <div class="mb-3">                                
                                <label for="review" class="form-label">Review</label>
                                <textarea name="review" id="review" rows="5" placeholder="Review" class="form-control @error('review') is-invalid @enderror">{{ old('review', $review->review) }}</textarea>
                                @error('review')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="1" {{ old('status', $review->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $review->status) == 0 ? 'selected' : '' }}>Block</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>    
                                @enderror
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