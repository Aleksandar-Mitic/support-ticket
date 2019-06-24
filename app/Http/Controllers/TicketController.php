<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::paginate(10);
        $categories = Category::all();

        return view('tickets.index', compact('tickets','categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message'  => 'required'
        ]);


        $ticket = new Ticket([
            'title'       => $request->input('title'),
            'user_id'     => Auth::user()->id,
            'ticket_id'   => strtoupper(str_random(10)),
            'category_id' => $request->input('category'),
            'priority'    => $request->input('priority'),
            'message'     => $request->input('message'),
            'status'      => "Open",
        ]);

        $ticket->save();

        return redirect()->back()->with("success", "A ticket with ID: #$ticket->ticket_id has been opened.");

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {

        $ticket = DB::select('select * from tickets where ticket_id = :ticket_id', ['ticket_id' => $ticket_id]);
        $user = Auth::user();

        if (Gate::allows('show-ticket', $ticket)){

        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $category = $ticket->category;

        $comments = $ticket->comments;

        return view('tickets.show', compact('ticket', 'category', 'comments'));

        } else {
            echo 'You  are not allowed';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function userTickets($user_id)
    {
        $tickets = Ticket::where('user_id', $user_id)->paginate(10);
        $categories = Category::all();

        return view('tickets.user_tickets', compact('tickets','categories'));
    }

}
