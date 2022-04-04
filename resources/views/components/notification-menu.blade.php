<!-- Nav Item - notification -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - notification -->
        <span class="badge badge-danger badge-counter">{{ $new }}</span>
    </a>
    <!-- Dropdown - notification -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 style="background-color:#af0c2d; border-color:#af0c2d" class="dropdown-header">
            Notification
        </h6>
        @foreach($notifications as $notification)

        <a class="dropdown-item d-flex align-items-center" href="{{ $notification->data['url'] }}?notify_id={{ $notification->id }}">
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    {{-- <div style="background-color:#af0c2d!important" class="icon-circle bg-primary"> --}}

                    <i class="fas fa-file-alt text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                    @if($notification->unread())
                    <span class="font-weight-bold">{{ $notification->data['body'] }}</span>
                    @endif
                    @if($notification->read())
                    <span class="font-weight-normal">{{ $notification->data['body'] }}</span>
                    @endif
            </div>
        </a>
        @endforeach


        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
    </div>
</li>
