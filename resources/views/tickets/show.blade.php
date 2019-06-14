@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            #{{ $ticket->ticket_id }} - {{ $ticket->title }}
        </div>

        <div class="panel-body">

            <div class="ticket-info">
                <p>{{ $ticket->message }}</p>
                <p>Category: {{ $category->name }}</p>
                    @include('partials.ticket_status')
                <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
            </div>

            <hr>

            <div class="comment-form">
                <form action="{{ url('comment') }}" method="POST" class="form">
                    @csrf

                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>

                        @if ($errors->has('comment'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

@endsection