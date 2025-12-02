@extends('layouts.app')

@section('main')  
     <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                @include('layouts.sidebar')               
            </div>
            <div class="col-md-9">
                @include('layouts.message')
                <div class="card border-0 shadow">
                    <div class="card-header text-white">
                        My Reviews
                    </div>
                    
                    <div class="card-body pb-0"> 
                        <div class="d-flex justify-content-end">
                            <form action="" method="get">
                                @csrf
                                <div class="d-flex"> 
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="{{ Request::get('keyword') }}">
                                    <button type="submit" class="btn btn-primary ms-2">Search</button>

                                    <a href="{{ route('user-reviews.index') }}" class="btn btn-secondary ms-2">Clear</a>
                                </div>
                            </form>
                        </div>           
                        <table class="table table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Review</th>
                                    <th>Book</th>                                    
                                    <th>Rating</th>
                                    <th>Status</th>                                  
                                    <th width="100">Action</th>
                                </tr>
                                    <tbody>
                                        @if($reviews->isNotEmpty())
                                            @foreach ($reviews as $review)
                                            <tr>    
                                                <td>{{ Str::limit($review->review, 50) }}</td>              
                                                <td>{{ $review->book->title }}</td>
                                                <td>{{ $review->rating }}</td>
                                                <td>
                                                    @if($review->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Block</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('user-reviews.edit', $review->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('user-reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?')">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr> 
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">No reviews found.</td>
                                            </tr>
                                        @endif
                                    </tbody>    
                            </thead>
                        </table>   
                         @if ($reviews->isNotEmpty())
                            {{ $reviews->links() }}      
                        @endif                    
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div>
@endsection