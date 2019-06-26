@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
    <div class="card panel-default">
        <div class="card-header">
            Ticket #{{ $ticket->ticket_id }} - {{ $ticket->title }} <br />
            Created by: {{ $user->name }}
            @can('update', $ticket)
                <a class="float-right" href="{{ route('ticket.edit', ['ticket' => $ticket->ticket_id]) }}"><button class="btn btn-primary">Edit ticket</button></a> 
            @endcan
        </div>

        <div class="card-body">
            @include('partials.status_flash')
            <div class="ticket-info">
                <p>{{ $ticket->message }}</p>
                <p>Category: {{ $category->name }}</p>
                <p> Ticket status: @include('partials.ticket_status') </p>
                <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
            </div>

            
            @include('partials.errors')
            @include('partials.success')
            <hr>

            <div class="my-3 p-3 bg-white rounded box-shadow">
                @if ( count($comments) )
                    <h6 class="border-bottom border-gray pb-2 mb-0">Recent comments</h6>
                    @foreach ($comments as $comment)
                        <div class="media text-muted pt-3">
                            <img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32"
                                class="mr-2 rounded" style="width: 32px; height: 32px;"
                                src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16b55c79276%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16b55c79276%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.0390625%22%20y%3D%2217.2%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                data-holder-rendered="true">
                            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                <strong class="d-block text-gray-dark">{{'@'}}{{ $comment->user->name }} <span class="float-right">{{ $comment->created_at->format('Y-m-d') }}</span></strong>

                                {{ $comment->comment }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>

            @can('update', $ticket)
                
                <h5>Add comment</h5>
                <div class="comment-form">
                    <form action="{{ url('comment') }}" method="POST" class="form">
                        @csrf

                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                            @if ($errors->has('comment'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            @endcan
        </div>

@endsection