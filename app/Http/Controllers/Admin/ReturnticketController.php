<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Returnticket;
use App\Model\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReturnticketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Returnticket::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.return-tickets.index', compact('tickets'));
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
        //
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

            $ticket = Returnticket::where('id', $id)->firstOrFail();
            return view('backend.admin.return-tickets.edit', compact('ticket'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.return-tickets.all'))->with('messageDanger', 'Whoops, Ticket Not Found !');
            }
            return redirect(route('admin.return-tickets.all'))->with('messageDanger', 'Whoops, something went wrong, try again later !');
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

            $ticket = Returnticket::where('id', $id)->firstOrFail();

            $ticket->update([
                'description' => $request->description,
                'status'      => $request->status,
            ]);

            if ($ticket->status == false) {

                $ticket->update([
                    'closed_at'   => now(),
                ]);

                Mail::send(['html' => 'backend.mails.ticket-closed'], ['ticket' => $ticket], function ($message) use ($ticket) {
                    $message->from('support@thehatkestore.com', 'HNI LIFESTYLE');
                    $message->to($ticket->email, 'HNI LIFESTYLE');
                    $message->subject('Closed:' . $ticket->subject . ' Ticket ID : ' . $ticket->id);
                });

                return redirect(route('admin.return-tickets.all'))->with('messageSuccess', 'Ticket has been Closed successfully with Ticket id : ' . $ticket->id);
            }

            return redirect(route('admin.return-tickets.all'))->with('messageSuccess', 'Ticket has been updated successfully with Ticket id : ' . $ticket->id);

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.return-tickets.all'))->with('messageDanger', 'Whoops, Ticket Not Found !');
            }
            return redirect(route('admin.return-tickets.all'))->with('messageDanger', 'Whoops, something went wrong, try again later !');
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
