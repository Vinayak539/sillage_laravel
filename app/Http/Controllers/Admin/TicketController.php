<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'       => 'required|email|max:191',
            'subject'     => 'required|string|max:191',
            'description' => 'nullable|string',
        ],
            [
                'email.required'   => 'Please Enter Customer Email ID',
                'email.email'      => 'Please Enter Proper Email ID',
                'subject.required' => 'Please Enter Subject',
                'subject.max'      => 'Please Enter Subject in 190 Characters',
            ]);

        $ticket = Ticket::create([
            'email'       => $request->email,
            'subject'     => $request->subject,
            'description' => $request->description,
            'open_by'     => auth('admin')->user()->name,
            'status'      => true,
        ]);

        Mail::send(['html' => 'backend.mails.ticket'], ['ticket' => $ticket], function ($message) use ($ticket) {
            $message->from('support@ranayas.com', 'Ranayas Store');
            $message->to($ticket->email, 'Ranayas');
            $message->subject('RE:' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
        });

        return redirect(route('admin.tickets.all'))->with('messageSuccess', 'Ticket has been Raised successfully with Ticket id : ' . $ticket->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $ticket = Ticket::where('id', $id)->firstOrFail();
            return view('backend.admin.tickets.edit', compact('ticket'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.tickets.all'))->with('messageDanger', 'Whoops, Ticket Not Found !');
            }
            return redirect(route('admin.tickets.all'))->with('messageDanger', 'Whoops, something went wrong, try again later !');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'nullable|string',
            'status'      => 'required|integer|max:1',
        ],
            [
                'status.required' => 'Please Select Status',
                'status.max'      => 'Invalid status provided',
            ]);

        try {

            $ticket = Ticket::where('id', $id)->firstOrFail();

            $ticket->update([
                'description' => $request->description,
                'status'      => $request->status,
            ]);
            
            if ($ticket->status == false) {
                
                $ticket->update([
                    'closed_at'   => now(),
                ]);

                Mail::send(['html' => 'backend.mails.ticket-closed'], ['ticket' => $ticket], function ($message) use ($ticket) {
                    $message->from('support@ranayas.com', 'Ranayas Store');
                    $message->to($ticket->email, 'Ranayas');
                    $message->subject('Closed:' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
                });

                return redirect(route('admin.tickets.all'))->with('messageSuccess', 'Ticket has been Closed successfully with Ticket id : ' . $ticket->id);
            }

            return redirect(route('admin.tickets.all'))->with('messageSuccess', 'Ticket has been updated successfully with Ticket id : ' . $ticket->id);

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.tickets.all'))->with('messageDanger', 'Whoops, Ticket Not Found !');
            }
            return redirect(route('admin.tickets.all'))->with('messageDanger', 'Whoops, something went wrong, try again later !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
