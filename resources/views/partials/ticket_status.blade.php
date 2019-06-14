@if ($ticket->status === 'Open')
    <button class="btn btn-primary">Open</button>
@elseif ($ticket->status === 'Not resolved')
    <button class="btn btn-danger">Not resolved</button>
@else
    <!-- Ticket is resolved -->
    <button class="btn btn-success">>Resolved</button>
@endif