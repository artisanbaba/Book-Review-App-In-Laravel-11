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
                    <div class="card-header  text-white">
                        Profile
                    </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="mt-3">Joined</h4>
                        <p class="text-muted">
                            Member since: {{ $user->created_at->format('d M, Y') }}
                        </p>
                    </div>

                    <hr>

                    <div class="row justify-content-center">                             
                        <div class="col-md-3 mb-3 text-center">
                            <label class="fw-bold ">Email</label>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div> 
                        <div class="col-md-3 mb-3 text-center">
                            <label class="fw-bold">Total Reviews</label>
                            <p class="text-muted">{{ $user->reviews->count() }}</p>
                        </div> 
                        <div class="col-md-3 mb-3 text-center">
                            <label class="fw-bold">Joined</label>
                            <p class="text-muted">{{ $user->created_at->format('d M, Y') }}</p>
                        </div> 
                    </div>

                    <div class="mt-3 text-end">
                        <a href="{{ route('account.editProfile', Auth::user()->id) }}" class="btn btn-primary btn-sm">Edit Profile</a>
                    </div>

                </div>
                </div>                
            </div>
        </div>       
    </div> 
@endsection