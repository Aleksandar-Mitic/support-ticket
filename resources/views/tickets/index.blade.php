@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')

    <div class="panel-heading">
        <i class="fa fa-ticket"> All Tickets</i>
    </div>

    <div class="panel-body">
        @if ($tickets->isEmpty())
            <p>No tickets tickets.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>
                            @foreach ($categories as $category)
                                @if ($category->id === $ticket->category_id)
                                    {{ $category->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('ticket.show', ['ticket' => $ticket->ticket_id]) }}">
                                #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                            </a>
                        </td>
                        <td>
                            @include('partials.ticket_status')
                        </td>
                        <td>{{ $ticket->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $tickets->links() }}</div>

        @endif
    </div>

@endsection