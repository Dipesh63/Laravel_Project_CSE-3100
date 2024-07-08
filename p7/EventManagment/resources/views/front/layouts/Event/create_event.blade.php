@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.layouts.sidebar')
                </div>
                <div class="col-lg-9">
                    {{-- <form action="{{ route('event.store') }}" method="post" id="createJobForm" name="createJobForm"> --}}
                        <form action="" method="post" id="createJobForm" name="createJobForm">
                        @csrf
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Event Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Event Title" id="title" name="title"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="DeptType" class="mb-2">Dept Type<span class="req">*</span></label>
                                        <select name="DeptType" id="DeptType" class="form-select">
                                            <option value="">Select Dept Type</option>
                                            @foreach ($deptTypes as $deptType)
                                                <option value="{{ $deptType->id }}">{{ $deptType->name }}</option>
                                            @endforeach
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="registrationfees" class="mb-2">Registration Fees</label>
                                        <input type="text" placeholder="Registration Fees" id="registrationfees"
                                            name="registrationfees" class="form-control">
                                            <p></p>
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <select name="location" id="location" class="form-control">
                                            <option value="">Select a Location</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description" style="width: 100%"></textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="benefits" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits" style="width: 100%"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="responsibility" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility" style="width: 100%"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications" style="width: 100%" ></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="duration" class="mb-2">Duration<span class="req">*</span></label>
                                    <select name="duration" id="duration" class="form-control">
                                        <option value="1">1 day</option>
                                        <option value="2">2 days</option>
                                        <option value="3">3 days</option>
                                        <option value="4">4 days</option>
                                        <option value="5">5 days</option>
                                        <option value="6">6 days</option>
                                        <option value="7">7 days</option>
                                        <option value="8">8 days</option>
                                        <option value="9">9 days</option>
                                        <option value="10">10 days</option>
                                        <option value="10_plus">10+ days</option>
                                    </select>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="keywords" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="Keywords" id="keywords" name="keywords"
                                        class="form-control">
                                </div>
                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Club Details</h3>
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="club_name" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Club Name" id="club_name" name="club_name"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-4 col-md-6">
                                        <label for="club_location" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="club_location"
                                            name="club_location" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="website" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="website"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn" style="background: rgb(0, 153, 255)">Save Event</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection




@section('CustomJs')
    <script type="text/javascript">
        $("#createJobForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);

            $.ajax({
                url: '{{ route('event.store') }}',
                type: 'POST',
                dataType: 'json',
                data: $("#createJobForm").serialize(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);

                    if (response.status == true) {
                        window.location.href = "{{ route('account.profile') }}";
                    } else {
                        var errors = response.errors;
                        // Handle errors by setting error messages
                        $.each(errors, function(key, value) {
                            // 
                            var errors = response.errors;

                            if (errors.title) {
                                $("#title").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.title)
                            } else {
                                $("#title").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }

                            if (errors.category) {
                                $("#category").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.category)
                            } else {
                                $("#category").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }

                            if (errors.DeptType) {
                                $("#DeptType").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.jobType)
                            } else {
                                $("#DeptType").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }

                            if (errors.vacancy) {
                                $("#vacancy").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.vacancy)
                            } else {
                                $("#vacancy").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }

                            if (errors.location) {
                                $("#location").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.location)
                            } else {
                                $("#location").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }

                            if (errors.description) {
                                $("#description").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.description)
                            } else {
                                $("#description").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }

                            if (errors.club_name) {
                                $("#club_name").addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.club_name)
                            } else {
                                $("#club_name").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('')
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection



{{-- @section('CustomJs')
    <script type="text/javascript">
        $("#createJobForm").submit(function(e) {
            e.preventDefault();
            $("button[type='submit']").prop('disabled', true);

            $.ajax({
                url: '{{ route('event.store') }}',
                type: 'POST',
                dataType: 'json',
                data: $("#createJobForm").serialize(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);

                    if (response.status == true) {
                        window.location.href = "{{ route('account.profile') }}";
                    } else {
                        var errors = response.errors;
                        // Handle errors by setting error messages
                        $.each(errors, function(key, value) {
                            var field = $("#" + key);
                            var errorElement = field.siblings('p');

                            if (value) {
                                field.addClass('is-invalid');
                                errorElement.addClass('invalid-feedback').html(value);
                            } else {
                                field.removeClass('is-invalid');
                                errorElement.removeClass('invalid-feedback').html('');
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection --}}
