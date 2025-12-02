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
                        Profile
                    </div>
                    
                    @include('layouts.message')

                    <form action="{{ route('account.updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ $user->name }}">
                                <label for="text" class="form-label">Name</label>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ $user->email }}">
                                    <label for="text" class="form-label">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

                                @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror 

                                @if (Auth::user()->image != "")
                                    <img src="{{ asset('uploads/profile/thumb/'. Auth::user()->image) }}" class="img-fluid mt-4" alt="">  
                                @endif    
                            </div>   
                            <button class="btn btn-primary mt-2">Update</button>                     
                        </div>
                    </form>

                     
 
                </div>                
            </div>
        </div>       
    </div> 
@endsection