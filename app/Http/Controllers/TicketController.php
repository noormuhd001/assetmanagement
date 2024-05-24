<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\TicketReplyRequest;
use App\Http\Requests\Ticket\TicketStoreRequest;
use Illuminate\Http\Request;
use App\Jobs\ticketjob;
use App\Services\TicketManagement\TicketManagementService;

class TicketController extends Controller
{
    private $ticketManagementService;

    public function __construct(TicketManagementService $ticketManagementService)
    {
        $this->ticketManagementService = $ticketManagementService;
    }
    public function raise()
    {
        try {
            $data = $this->ticketManagementService->raise();
            if($data){
                return view("ticket.index", $data);
            }else{
               return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function submit(TicketStoreRequest $request)
    {
        try {
            $user = $this->ticketManagementService->submitticket($request);
            if ($user) {
                dispatch(new ticketjob($user));
                return redirect()->back()->with('success', 'Ticket submitted successfully!');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }


    public function display()
    {
        try {
            $data = $this->ticketManagementService->displayticket();
            return view('ticket.display', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function show($id)
    {
        try {
            $data = $this->ticketManagementService->showticket($id);
            return view('ticket.show', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function reply(TicketReplyRequest $request, $id)
    {
        try {
            $user = $this->ticketManagementService->replyticket($request, $id);
            if ($user) {
                dispatch(new ticketjob($user));
                return redirect()->back()->with('success', 'Reply sent successfully!');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function admindisplay()
    {
        try {
            $data = $this->ticketManagementService->admindisplayticket();
            return view('ticket.admindisplay', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function adminshow($id)
    {
        try {
            $data = $this->ticketManagementService->adminshowticket($id);
            return view('ticket.adminshow', $data);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function ticketclose($id)
    {
        try {
            $ticket = $this->ticketManagementService->ticketcloseticket($id);

            if ($ticket) {
                return redirect()->back()->with('success', 'ticket close successfully');
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }

    public function adminreply(TicketReplyRequest $request, $id)
    {
        try {
            $user = $this->ticketManagementService->adminreplyticket($request, $id);
            if ($user) {
                dispatch(new ticketjob($user));
                return redirect()->back()->with('success', 'Reply sent successfully!');
            } {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
