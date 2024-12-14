@extends('layouts.main')
@section('content')
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Latest Log</h4>
            <div class="table-responsive">
                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Details</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->user->name ?? 'System' }}</td>
                                <td>
                                    @php
                                        $rawAction = $log->action;
                                        $actionJson = null;
                
                                        // Check if the action contains JSON
                                        if (str_contains($rawAction, '{')) {
                                            $jsonStart = strpos($rawAction, '{');
                                            $plainText = substr($rawAction, 0, $jsonStart);
                                            $jsonString = substr($rawAction, $jsonStart);
                
                                            try {
                                                $actionJson = json_decode($jsonString, true);
                                            } catch (\Exception $e) {
                                                $actionJson = null; // Handle invalid JSON
                                            }
                                        }
                                    @endphp
                
                                    @if(isset($plainText))
                                        <strong>{{ $plainText }}</strong><br>
                                    @endif
                
                                    @if($actionJson)
                                        @foreach($actionJson as $key => $value)
                                            <span>{{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value ?? 'null' }}</span><br>
                                        @endforeach
                                    @else
                                        {{ $rawAction }}
                                    @endif
                                </td>
                                <td>{{ $log->module }}</td>
                                <td>
                                    @php
                                        $rawDetails = $log->details;
                                        $detailsJson = null;
                
                                        // Check if the details contain JSON
                                        try {
                                            $detailsJson = json_decode($rawDetails, true);
                                        } catch (\Exception $e) {
                                            $detailsJson = null;
                                        }
                                    @endphp
                
                                    @if($detailsJson)
                                        @foreach($detailsJson as $key => $value)
                                            <span>{{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value ?? 'null' }}</span><br>
                                        @endforeach
                                    @else
                                        {{ $rawDetails }}
                                    @endif
                                </td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection
