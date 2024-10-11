@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">AWS EC2 Instances</h4>

                <div class="table-responsive">
                    <table class="table table-nowrap align-middle">
                        <thead>
                            <tr>
                                <th>Instance ID</th>
                                <th>State</th>
                                <th>Type</th>
                                <th>Public DNS</th>
                                <th>Launch Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="instance-list">
                            @foreach ($instances as $instance)
                                <tr id="instance-{{ $instance['id'] }}">
                                    <td>{{ $instance['id'] }}</td>
                                    <td class="state">
                                        @if ($instance['state'] === 'running')
                                            <span class="badge bg-success">Running</span>
                                        @else
                                            <span class="badge bg-warning">Stopped</span>
                                        @endif
                                    </td>
                                    <td>{{ $instance['type'] }}</td>
                                    <td class="public-dns">{{ $instance['public_dns'] ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($instance['launch_time'])->format('Y-m-d H:i:s') }}</td>
                                    <td style="width: 200px;">
                                        <!-- Start/Stop Buttons -->
                                        @if ($instance['state'] === 'stopped')
                                            <a href="{{ route('ec2.start', $instance['id']) }}" class="btn btn-success btn-sm">Start</a>
                                        @else
                                            <a href="{{ route('ec2.stop', $instance['id']) }}" class="btn btn-danger btn-sm">Stop</a>
                                        @endif
                                        
                                        <!-- RDP Download Button -->
                                        <a href="{{ route('ec2.downloadRdp', $instance['id']) }}" class="btn btn-primary btn-sm" title="Download RDP">
                                            <i class="fas fa-download"></i> RDP
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to update the status of the instances
    function updateInstanceStatuses() {
        $.ajax({
            url: "{{ route('ec2.status') }}",
            method: 'GET',
            success: function(response) {
                response.forEach(function(instance) {
                    var row = $('#instance-' + instance.id);
                    
                    // Update the state (Running/Stopped)
                    var stateBadge = instance.state === 'running' 
                        ? '<span class="badge bg-success">Running</span>' 
                        : '<span class="badge bg-warning">Stopped</span>';
                    row.find('.state').html(stateBadge);

                    // Update the public DNS
                    row.find('.public-dns').text(instance.public_dns || 'N/A');

                    // Update the Start/Stop buttons
                    var actionButtons = instance.state === 'stopped' 
                        ? '<a href="{{ route('ec2.start', '') }}/' + instance.id + '" class="btn btn-success btn-sm">Start</a>'
                        : '<a href="{{ route('ec2.stop', '') }}/' + instance.id + '" class="btn btn-danger btn-sm">Stop</a>';
                    
                    actionButtons += ' <a href="{{ route('ec2.downloadRdp', '') }}/' + instance.id + '" class="btn btn-primary btn-sm" title="Download RDP"><i class="fas fa-download"></i> RDP</a>';
                    
                    row.find('td:last-child').html(actionButtons);
                });
            },
            error: function(error) {
                console.log("Error fetching instance statuses:", error);
            }
        });
    }

    // Refresh the instance statuses every 10 seconds
    setInterval(updateInstanceStatuses, 5000);
</script>
@endsection
