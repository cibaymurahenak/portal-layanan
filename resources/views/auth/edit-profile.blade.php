@extends('layouts.navapp')

@section('content')
<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3 class="mb-4">Edit Profile</h3>
            <div class="card p-4">
                <form class="form-card" onsubmit="event.preventDefault()">
                    <div class="row mb-3">
                        <div class="form-group col-sm-6">
                            <label for="fname" class="form-label">Item yang diganti <span class="text-danger">*</span></label>
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter your Item yang diganti" onblur="validate(1)">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="lname" class="form-label">Item yang diganti <span class="text-danger">*</span></label>
                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter your Item yang diganti" onblur="validate(2)">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-sm-6">
                            <label for="email" class="form-label">Item yang diganti <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Item yang diganti" onblur="validate(3)">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="mob" class="form-label">Item yang diganti <span class="text-danger">*</span></label>
                            <input type="tel" id="mob" name="mob" class="form-control" placeholder="Enter your Item yang diganti" onblur="validate(4)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            {{-- <button type="button" class="btn btn-secondary btn-block" onclick="{{route('profile')}}">Back</button> --}}
                            <a class="btn btn-secondary" href="{{route('profile')}}">Back</a>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" class="btn btn-primary btn-block">Done</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
