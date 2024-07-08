{{-- @extends('front.layouts.app')
@section('main')

<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('event.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>





    
<!-- Messages Section -->
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div id="ajaxMessage" class="alert" style="display:none;"></div>
</div>







    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $events->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $events->location->name }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $events->depttype->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{{ $events->description }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                             <p>{{ $events->responsibility }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            <p>{{ $events->qualifications }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            <p>{{ $events->benefits }}</p>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            <a href="#" class="btn btn-secondary">Save</a>

                            @if(Auth::check())
                                <a href="#" onclick="applyjob({{ $events->id }})" class="btn btn-primary">Apply</a>
                             @else
                                <a href="#" class="btn btn-primary disabled">Login to Apply</a>
                             @endif

                        </div>
                    </div>
                </div>
























@if (Auth::user())
@if (Auth::user()->id == $events->user_id)

<div class="card shadow border-0 mt-4">
    <div class="job_details_header">
        <div class="single_jobs white-bg d-flex justify-content-between">
            <div class="jobs_left d-flex align-items-center">
                <div class="jobs_conetent">
                    <h4>Applicants</h4>
                </div>
            </div>
            <div class="jobs_right"></div>
        </div>
    </div>
    <div class="descript_wrap white-bg">
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Applied Date</th>
            </tr>
            @if ($applications->isNotEmpty())
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $application->admittedUser->name }}</td>
                        <td>{{ $application->admittedUser->email }}</td>
                        <td>{{ $application->admittedUser->mobile }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Applicants not found</td>
                </tr>
            @endif
        </table>
    </div>
</div>
@endif
@endif































            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ $events->created_at }}</span></li>
                                <li>Vacancy: <span>{{ $events->vacancy }} </span></li>
                                <li>Salary: <span>{{ $events->registrationfees }}</span></li>
                                <li>Location: <span>{{ $events->location->name }}</span></li>
                                <li>Job Nature: <span> {{ $events->depttype->name }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{ $events->club_name }}</span></li>
                                <li>Location: <span>{{ $events->club_location }}</span></li>
                                <li>Website: <span><a href="#">{{ $events->club_website }}</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection







@section('CustomJs')
<script type="text/javascript">

function applyjob(id) {
    var confirmation = confirm("Do you sure you want to apply?");
    if (confirmation) {
        // User clicked 'OK'
        // Your code for handling the confirmation
        //console.log("User clicked OK");
        var csrfToken = $('meta[name="csrf-token"]').attr('content');      
        $.ajax({
            url: '{{ route('applyJob') }}',
            type: 'post',
            data: {
                _token: csrfToken,
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // Handle success response
                window.location.href = "{{ url()->current() }}";
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    } else {
        
        console.log("User clicked Cancel or closed the dialog");
    }
}


</script>
@endsection



 --}}




















 @extends('front.layouts.app')
@section('main')

<section class="section-4 bg-2">    
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('event.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                    </ol>
                </nav>
            </div>
        </div> 
    </div>

    <!-- Messages Section -->
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div id="ajaxMessage" class="alert" style="display:none;"></div>
    </div>

    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $events->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p><i class="fa fa-map-marker"></i> {{ $events->location->name ?? 'Location not specified' }}</p>
                                        </div>
                                        <div class="location">
                                            <p><i class="fa fa-clock-o"></i> {{ $events->depttype->name ?? 'Dept type not specified' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job description</h4>
                            <p>{{ $events->description }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Responsibility</h4>
                            <p>{{ $events->responsibility }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Qualifications</h4>
                            <p>{{ $events->qualifications }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            <p>{{ $events->benefits }}</p>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            <a href="#" class="btn btn-secondary">Save</a>

                            @if(Auth::check())
                                <a href="#" onclick="applyjob({{ $events->id }})" class="btn btn-primary">Apply</a>
                            @else
                                <a href="#" class="btn btn-primary disabled">Login to Apply</a>
                            @endif
                        </div>
                    </div>
                </div>







                @if (Auth::check() && Auth::user()->id == $events->user_id)
                    <div class="card shadow border-0 mt-4">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                        <h4>Applicants</h4>
                                    </div>
                                </div>
                                <div class="jobs_right"></div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Applied Date</th>
                                </tr>
                                @if ($applications->isNotEmpty())
                                    @foreach ($applications as $application)
                                        {{-- <tr>
                                            <td>{{ $application->admittedUser->name }}</td>
                                            <td>{{ $application->admittedUser->email }}</td>
                                            <td>{{ $application->admittedUser->mobile }}</td>
                                            <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</td>
                                        </tr> --}}
                                        <tr>
                                            <td>{{ $application->admittedUser->name ?? 'N/A' }}</td>
                                            <td>{{ $application->admittedUser->email ?? 'N/A' }}</td>
                                            <td>{{ $application->admittedUser->mobile ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</td>
                                        </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">Applicants not found</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                @endif




            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Published on: <span>{{ $events->created_at }}</span></li>
                                <li>Vacancy: <span>{{ $events->vacancy }}</span></li>
                                <li>Salary: <span>{{ $events->registrationfees }}</span></li>
                                <li>Location: <span>{{ $events->location->name ?? 'Location not specified' }}</span></li>
                                <li>Job Nature: <span>{{ $events->depttype->name ?? 'Dept type not specified' }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{ $events->club_name }}</span></li>
                                <li>Location: <span>{{ $events->club_location }}</span></li>
                                <li>Website: <span><a href="#">{{ $events->club_website }}</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('CustomJs')
<script type="text/javascript">
    function applyjob(id) {
        var confirmation = confirm("Do you sure you want to apply?");
        if (confirmation) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');      
            $.ajax({
                url: '{{ route('applyJob') }}',
                type: 'post',
                data: {
                    _token: csrfToken,
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ url()->current() }}";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            console.log("User clicked Cancel or closed the dialog");
        }
    }
</script>
@endsection

