@extends("front.layout.master")
@section('title','Profile')
@section('body')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Profile</h4>
                        <div class="breadcrumb__links">
                            <a href="./ ">Home</a>
                            <span>Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container pt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            <div class="mt--7 my-3">
                <form class="row" method="POST" action="{{ route('updateUser') }}" enctype="multipart/form-data">
                @csrf
                @if(Auth::check())
                <div class="row">
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                        <div class="card card-profile">
                            <div class="row justify-content-center my-3">
                                <div class="col-lg-12 order-lg-2">
                                    <div class="card-profile-image">
                                        <a href="#">
                                            <img width="200" height="200" style="background-size: cover;background-repeat: no-repeat;object-fit: cover" src="{{ Auth::user()->avatar == null ? asset('front/img/user/default-avatar.png') : asset('front/img/user/' . Auth::user()->avatar) }}" class="rounded-circle">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                        <input type="file" class="form-control-file" id="avatar" name="avatar">

                                        <p class="text-black-50">*Image Size <= 2Mb</p>
                                        @error("avatar")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror


                            </div>

                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1">
                        <div class="card bg-light">

                            <div class="card-body">

                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="name">Username</label>
                                                    <input type="text" name="name" id="name" class="form-control form-control-alternative" value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="email">Email address</label>
                                                    <input type="email" name="email" id="email" class="form-control form-control-alternative" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="dateOfBirth">Date of Birth:</label>
                                                <input name="dateOfBirth" type="date" class="form-control" id="dateOfBirth" value="{{ Auth::user()->date_of_birth }}">
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="phone">Phone:</label>
                                                <input name="phone" type="number" class="form-control" id="phone" value="{{ Auth::user()->phone }}">
                                            </div>

                                        </div>


                                    </div>
                                    <hr class="my-4">
                                    <!-- Address -->
                                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="address">Address</label>
                                                    <textarea id="address" name="address" class="form-control form-control-alternative" type="text">{{ Auth::user()->street_address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col pb-2">
                                                <label class="form-control-label" for="company">Company</label>
                                                <input type="text" id="company" name="company" class="form-control form-control-alternative" value="{{ Auth::user()->company }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="city">City</label>
                                                    <input type="text" id="city" name="city" class="form-control form-control-alternative" value="{{ Auth::user()->town_city }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="country">Country</label>
                                                    <input type="text" id="country" name="country" class="form-control form-control-alternative" value="{{ Auth::user()->country }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="postCode">Postal code</label>
                                                    <input type="number" id="postCode" name="postCode" class="form-control form-control-alternative" value="{{ Auth::user()->postcode_zip }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <!-- Description -->
                                    <h6 class="heading-small text-muted mb-4"></h6>
                                    <div class="pl-lg-4">
                                        <div class="form-group focused">
                                            <button type="submit" class="primary-btn-hero float-right">Update</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                </form>
            </div>

    </div>


@endsection
