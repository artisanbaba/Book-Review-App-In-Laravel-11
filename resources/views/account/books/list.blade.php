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
                        Books
                    </div>
                    
                    @include('layouts.message')

                    <div class="card-body pb-0">    
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
                            <form action="" method="get">
                                @csrf
                                <div class="d-flex"> 
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="{{ Request::get('keyword') }}">
                                    <button type="submit" class="btn btn-primary ms-2">Search</button>

                                    <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Clear</a>
                                </div>
                            </form>
                        </div>
                        <table class="table  table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                                <tbody>
                                    @if ($books->isNotEmpty())
                                        @foreach ($books as $book )

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
                                        
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ number_format($avgRating, 1) }} ({{ ($ratingCount > 1) ? $ratingCount . ' Reviews' : $ratingCount . ' Review' }})</td>
                                            <td>
                                                @if ($book->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Block</span>
                                                @endif
                                            </td>
                                            
                                            <td class="actionBtn">
                                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-success btn-sm"><i class="fa-regular fa-eye"></i></a>

                                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                                </a>  
                                                
                                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                            </td>
                                        </tr> 
                                        @endforeach
                                    @endif 
                                </tbody>
                            </thead>
                        </table>   
                        @if ($books->isNotEmpty())
                        {{ $books->links() }}      
                        @endif                        
                    </div>
                    
                </div>                
            </div>
        </div>       
    </div> 
@endsection
