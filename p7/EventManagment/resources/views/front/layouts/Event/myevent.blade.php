{{-- @extends('front.layouts.app')
@section('main')

<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
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
               
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">My Events</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="{{ route('event.create') }}" class="btn btn-primary">Post an Event</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Event Created</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($events->isNotEmpty())
                                        @foreach ($events as $event)
                                        <tr class="active">
                                            <td>
                                                <div class="job-name fw-500">{{ $event->title }}</div>
                                                <div class="info1">{{ $event->depttype->name }} . {{ $event->location->name }}</div>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d M, Y') }}</td>
                                            <td>0 Applications</td>
                                            <td>
                                                @if ($event->status == 1)
                                                <div class="job-status text-capitalize">Active</div>
                                                @else
                                                <div class="job-status text-capitalize">Blocked</div>
                                                @endif                                    
                                            </td>
                                            <td>
                                                <div class="action-dots float-end">
                                                    <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="{{ route('event.eventDetail', $event->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                        <li><a class="dropdown-item delete-event" href="#"  onclick="deleteJob({{ $event->id }})"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No events found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $events->links() }}
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
@endsection -




@section('customJs')
<script type="text/javascript">   
function deleteJob(eventId) {
    if (confirm("Are you sure you want to delete?")) {
        $.ajax({
            url : '{{ route("event.delete") }}',
            type: 'post',
            data: {eventId: eventId},
            dataType: 'json',
            success: function(response) {
                window.location.href='{{ route("event.myevents") }}';
            }
        });
    } 
}
</script>
@endsection


 --}}



















 @extends('front.layouts.app')
 @section('main')
 
 <section class="section-5 bg-2">
     <div class="container py-5">
         <div class="row">
             <div class="col">
                 <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
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
                 <div class="card border-0 shadow mb-4 p-3">
                     <div class="card-body card-form">
                         <div class="d-flex justify-content-between">
                             <div>
                                 <h3 class="fs-4 mb-1">My Events</h3>
                             </div>
                             <div style="margin-top: -10px;">
                                 <a href="{{ route('event.create') }}" class="btn btn-primary">Post an Event</a>
                             </div>
                         </div>
                         <div class="table-responsive">
                             <table class="table">
                                 <thead class="bg-light">
                                     <tr>
                                         <th scope="col">Title</th>
                                         <th scope="col">Event Created</th>
                                         <th scope="col">Applicants</th>
                                         <th scope="col">Status</th>
                                         <th scope="col">Action</th>
                                     </tr>
                                 </thead>
                                 <tbody class="border-0">
                                     @if ($events->isNotEmpty())
                                         @foreach ($events as $event)
                                             <tr class="active">
                                                 <td>
                                                     <div class="job-name fw-500">{{ $event->title }}</div>
                                                     <div class="info1">{{ $event->depttype->name }} . {{ $event->location->name }}</div>
                                                 </td>
                                                 <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d M, Y') }}</td>
                                                 <td>0 Applications</td>
                                                 <td>
                                                     @if ($event->status == 1)
                                                         <div class="job-status text-capitalize">Active</div>
                                                     @else
                                                         <div class="job-status text-capitalize">Blocked</div>
                                                     @endif                                    
                                                 </td>
                                                 <td>
                                                     <div class="action-dots float-end">
                                                         <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                                             <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-end">
                                                             <li><a class="dropdown-item" href="{{ route('event.eventDetail', $event->id) }}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                             <li>
                                                                 <form method="POST" action="{{ route('event.delete', $event->id) }}" class="delete-event-form">
                                                                     @csrf
                                                                     @method('DELETE')
                                                                     <button type="submit" class="dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                                 </form>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @endforeach
                                     @else
                                         <tr>
                                             <td colspan="5" class="text-center">No events found.</td>
                                         </tr>
                                     @endif
                                 </tbody>
                             </table>
                         </div>
                         <div>
                             {{ $events->links() }}
                         </div>
                     </div>
                 </div>                
             </div>
         </div>
     </div>
 </section>
 @endsection
 
 @section('customJs')
 <script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function () {
         document.querySelectorAll('.delete-event-form').forEach(function (form) {
             form.addEventListener('submit', function (event) {
                 event.preventDefault();
                 
                 if (confirm("Are you sure you want to delete this event?")) {
                     this.submit();
                 }
             });
         });
     });
 </script>
 @endsection
 