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
                    Change Password
                </div>

                <div class="card-body">
                    
                    @include('layouts.message')               

                    <form action="{{ route('account.updatePassword') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" 
                                name="current_password" 
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Enter current password">

                            @error('current_password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" 
                                name="new_password" 
                                class="form-control @error('new_password') is-invalid @enderror"
                                placeholder="Enter new password">

                            @error('new_password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" 
                                name="confirm_password" 
                                class="form-control @error('confirm_password') is-invalid @enderror"
                                placeholder="Confirm new password">

                            @error('confirm_password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>


                        <button class="btn btn-primary mt-2">Update Password</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
