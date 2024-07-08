{{-- @extends('front.layouts.app')
@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="">Latest</option>
                            <option value="">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">



            <form name="searchform" id="searchform">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input type="text"  name="keywords" id="keywords" placeholder="Keywords" class="form-control">
                        </div>

                        <div class="mb-4">
                            <h2>Location</h2>
                           

                            <select name="location" id="location" class="form-control">
                                <option value="">Select a Location</option>
                                @if ($locations)
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @if ($depttypes)
                                @foreach ($depttypes as $depttype)
                                    <input class="form-check-input school-section" name="depttype"  id="depttype"  type="checkbox"
                                        value="{{ $depttype->id }}" id="{{ $depttype->id }}">
                                    <label class="form-check-label " for="{{ $depttype->id }}">{{ $depttype->name }}</label>
                                @endforeach
                            @endif
                           
                        </div>

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <select name="duration" id="duration" class="form-control">
                                <option value="">Select Experience</option>
                                <option value="">1 Year</option>
                                <option value="">2 Years</option>
                                <option value="">3 Years</option>
                                <option value="">4 Years</option>
                                <option value="">5 Years</option>
                                <option value="">6 Years</option>
                                <option value="">7 Years</option>
                                <option value="">8 Years</option>
                                <option value="">9 Years</option>
                                <option value="">10 Years</option>
                                <option value="">10+ Years</option>
                            </select>
                        </div>

<button type="submit" class="btn btn primary">Search</button>

                    </div>


         </form>






                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">

                                @if ($events)
                                @foreach ($events as $event )
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $event->title }}</h3>
                                            <p>{{ $event->description }}</p>
                                            <div class="bg-light p-3 border">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $event->location->name }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $event->Depttype->name }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{ $event->registrationfees }}</span>
                                                </p>
                                            </div>

                                            <div class="d-grid mt-3">
                                                <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                    
                                @endif

                               

                               

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@section('CustomJs')
<script>
$(document).ready(function() {
    // Handle form submission
    $("#searchform").submit(function(e) {
        e.preventDefault();

        // Get form input values
        var keyword = $("#keywords").val();
        var location = $("#location").val();
        var category = $("#category").val();
        var duration = $("#duration").val();
        var sort = $("#sort").val();

        var checkedJobTypes = $("input:checkbox[name='depttype']:checked").map(function() {
            return $(this).val();
        }).get();

        // Construct URL with form input values
        var url = '{{ route("event.index") }}?';

        if (keyword) {
            url += 'keywords=' + keyword + '&';
        }

        if (location) {
            url += 'location=' + location + '&';
        }

        if (category) {
            url += 'category=' + category + '&';
        }

        if (duration) {
            url += 'duration=' + duration + '&';
        }

        if (checkedJobTypes.length > 0) {
            url += 'depttype=' + checkedJobTypes.join(',') + '&';
        }

        if (sort) {
            url += 'sort=' + sort;
        }

        // Redirect to the constructed URL
        window.location.href = url;
    });

    // Handle sorting change
    $("#sort").change(function() {
        $("#searchform").submit();
    });
});
</script>
@endsection --}}
























@extends('front.layouts.app')
@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option value="">Latest</option>
                            <option value="">Oldest</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form name="searchform" id="searchform">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" name="keywords" id="keywords" placeholder="Keywords" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <select name="location" id="location" class="form-control">
                                    <option value="">Select a Location</option>
                                    @if ($locations)
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if ($categories)
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="mb-4">
                                <h2>Job Type</h2>
                                @if ($depttypes)
                                    @foreach ($depttypes as $depttype)
                                        <input class="form-check-input school-section" name="depttype" type="checkbox"
                                               value="{{ $depttype->id }}" id="{{ $depttype->id }}">
                                        <label class="form-check-label" for="{{ $depttype->id }}">{{ $depttype->name }}</label>
                                    @endforeach
                                @endif
                            </div>

                            <div class="mb-4">
                                <h2>Experience</h2>
                                <select name="duration" id="duration" class="form-control">
                                    <option value="">Select Experience</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }} Year{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                    <option value="10+">10+ Years</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-8 col-lg-9">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if ($events)
                                    @foreach ($events as $event)
                                        <div class="col-md-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $event->title }}</h3>
                                                    <p>{{ $event->description }}</p>
                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $event->location->name }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1">{{ $event->Depttype->name }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $event->registrationfees }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('event.eventDetail',$event->id) }}" class="btn btn-primary btn-lg">Details</a>
                                                        <a href="{{ route('event.comment', ['event_id' => $event->id, 'sender_id' => Auth::id(), 'organizer_id' => $event->user_id]) }}" class="btn btn-primary btn-lg">Comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
<script>
$(document).ready(function() {
    // Handle form submission
    $("#searchform").submit(function(e) {
        e.preventDefault();

        // Get form input values
        var keyword = $("#keywords").val();
        var location = $("#location").val();
        var category = $("#category").val();
        var duration = $("#duration").val();
        var sort = $("#sort").val();

        var checkedJobTypes = $("input:checkbox[name='depttype']:checked").map(function() {
            return $(this).val();
        }).get();

        // Construct URL with form input values
        var url = '{{ route("event.index") }}?';

        if (keyword) {
            url += 'keywords=' + keyword + '&';
        }

        if (location) {
            url += 'location=' + location + '&';
        }

        if (category) {
            url += 'category=' + category + '&';
        }

        if (duration) {
            url += 'duration=' + duration + '&';
        }

        if (checkedJobTypes.length > 0) {
            url += 'depttype=' + checkedJobTypes.join(',') + '&';
        }

        if (sort) {
            url += 'sort=' + sort;
        }

        // Redirect to the constructed URL
        window.location.href = url;
    });

    // Handle sorting change
    $("#sort").change(function() {
        $("#searchform").submit();
    });
});
</script>
@endsection

