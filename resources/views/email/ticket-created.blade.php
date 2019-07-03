@component('mail::message')
Ticket id: #{{ $ticket->ticket_id }} 

New ticket has been opened.

@component('mail::button', ['url' => $ticket_link])
Review
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
