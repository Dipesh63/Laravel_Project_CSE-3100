@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route("dashboardindex") }}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.layouts.admin.adminsidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                 
                <form action="" method="post" id="editeventForm" name="editeventForm">
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Event Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input value="{{ $event->title }}" type="text" placeholder="Event Title" id="title" name="title" class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                            <option {{ ($event->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Dept Type<span class="req">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select">
                                        <option value="">Select Dept Type</option>
                                        @if ($depttypes->isNotEmpty())
                                            @foreach ($depttypes as $deptType)
                                            <option {{ ($event->dept_type_id == $deptType->id) ? 'selected' : '' }} value="{{ $deptType->id }}">{{ $deptType->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                    <input value="{{ $event->vacancy }}" type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">registrationfees</label>
                                    <input value="{{ $event->registrationfees }}" type="text" placeholder="registrationfees" id="registrationfees" name="registrationfees" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    {{-- <input value="{{ $event->location }}" type="text" placeholder="Location" id="location" name="location" class="form-control"> --}}
                                    <select name="location" id="location" class="form-control">
                                        <option value="">Select a Location</option>
                                        @if ($locations->isNotEmpty())
                                            @foreach ($locations as $location)
                                            <option {{ ($event->location_id == $location->id) ? 'selected' : '' }} value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="mb-4 col-md-6">
                                    <div class="form-check">
                                        <input {{ ($event->isFeatured == 1) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="1" id="isFeatured" name="isFeatured">
                                        <label class="form-check-label" for="isFeatured">
                                            Featured
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-4 col-md-6">
                                    <div class="form-check-inline">
                                        <input {{ ($event->status == 1) ? 'checked' : '' }} class="form-check-input" type="radio" value="1" id="status-active" name="status">
                                        <label class="form-check-label" for="status">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <input {{ ($event->status == 0) ? 'checked' : '' }} class="form-check-input" type="radio" value="0" id="status-block" name="status">
                                        <label class="form-check-label" for="status">
                                            Block
                                        </label>
                                    </div>
                                </div>
                            </div>

                            
                        

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description" style="width: 100%">{{ $event->description }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits" style="width: 100%">{{ $event->benefits }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility" style="width: 100%">{{ $event->responsibility }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications" style="width: 100%" >{{ $event->qualifications }}  </textarea>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">duration <span class="req">*</span></label>
                                <select name="duration" id="duration" class="form-control">
                                    <option value="1" {{ ($event->duration == 1) ? 'selected' : '' }}>1 day</option>
                                    <option value="2" {{ ($event->duration == 2) ? 'selected' : '' }}>2 days</option>
                                    <option value="3" {{ ($event->duration == 3) ? 'selected' : '' }}>3 days</option>
                                    <option value="4" {{ ($event->duration == 4) ? 'selected' : '' }}>4 days</option>
                                    <option value="5" {{ ($event->duration == 5) ? 'selected' : '' }}>5 days</option>
                                    <option value="6" {{ ($event->duration == 6) ? 'selected' : '' }}>6 days</option>
                                    <option value="7" {{ ($event->duration == 7) ? 'selected' : '' }}>7 days</option>
                                    <option value="8" {{ ($event->duration == 8) ? 'selected' : '' }}>8 days</option>
                                    <option value="9" {{ ($event->duration == 9) ? 'selected' : '' }}>9 days</option>
                                    <option value="10" {{ ($event->duration == 10) ? 'selected' : '' }}>10 days</option>
                                    <option value="10_plus" {{ ($event->duration == '10_plus') ? 'selected' : '' }}>10+ days</option>
                                </select>
                                <p></p>
                            </div>
                            
                            

                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords</label>
                                <input value="{{ $event->keywords }}" type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">club Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input value="{{ $event->club_name }}" type="text" placeholder="club Name" id="club_name" name="club_name" class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input value="{{ $event->club_location }}" type="text" placeholder="Location" id="club_location" name="club_location" class="form-control">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Website</label>
                                <input type="text" value="{{ $event->club_website }}" placeholder="Website" id="website" name="website" class="form-control">
                            </div>
                        </div> 
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
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
    $("#editeventForm").submit(function(e){
        e.preventDefault();
        $("button[type='submit']").prop('disabled',true);
        $.ajax({
            url: '{{ route("admin.events.update",$event->id) }}',
            type: 'PUT',
            dataType: 'json',
            data: $("#editeventForm").serializeArray(),
            success: function(response) {
                $("button[type='submit']").prop('disabled',false);
                if(response.status == true) {

                    $("#title").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#category").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#jobType").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#vacancy").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#location").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')


                    $("#description").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#club_name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    window.location.href="{{ route('dashboardindex') }}";

                } else {
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

                    if (errors.jobType) {
                        $("#jobType").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.jobType)
                    } else {
                        $("#jobType").removeClass('is-invalid')
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
                }

            }
        });
    });

    
</script>
@endsection