<?php

namespace App\Http\Controllers;

use App\Enums\TicketTypeEnum;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\ResolveTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * @return mixed
     *
     */
    public function index()
    {
        $user = auth()->user();
        $canCreate = $user->isQA() || $user->isPM();

        $query = Ticket::query()->with(['creator', 'resolver']);

        $tickets = $query->paginate();

        if ($user->isRD()) {
            $tickets->each(function ($ticket) use ($user) {
                $ticket->canBeResolved = in_array($ticket->type, array_Keys(TicketTypeEnum::MAP_FOR_RESOLVING_BY_RD));
            });
        } elseif ($user->isQA()) {
            $tickets->each(function ($ticket) use ($user) {
                $ticket->canBeResolved = $ticket->type == TicketTypeEnum::TEST_CASE;
            });
        }

        return view('ticket.index', [
            'tickets' => $tickets,
            'canCreate' => $canCreate,
        ]);
    }

    /**
     * @param CreateTicketRequest $request
     * @return mixed
     */
    public function create(CreateTicketRequest $request)
    {
        $types = [];

        if(auth()->user()->isQA()) {
            $types = TicketTypeEnum::MAP_FOR_EDITING_BY_QA;
        } else {
            $types = TicketTypeEnum::MAP_FOR_EDITING_BY_PM;
        }

        return view('ticket.create', ['ticketTypes' => $types]);
    }

    /**
     * @param StoreTicketRequest $request
     * @return mixed
     */
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create(
            $request->validated() + [
                'creator_id' => auth()->user()->id
            ]
        );

        return redirect()->route('tickets');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit(Ticket $ticket)
    {
        $user = auth()->user();

        $canEdit = false;

        if ($user->isQA()) {
            $canEdit = in_array($ticket->type, array_keys(TicketTypeEnum::MAP_FOR_EDITING_BY_QA));
        } elseif ($user->isPM()) {
            $canEdit = in_array($ticket->type, array_keys(TicketTypeEnum::MAP_FOR_EDITING_BY_PM));
        }


        return view('ticket.edit', ['ticket' => $ticket, 'canEdit' => $canEdit]);
    }

    /**
     * @param UpdateTicketRequest $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->fill($request->validated());
        $ticket->save();

        return redirect()->route('tickets');
    }

    /**
     * @param ResolveTicketRequest $request
     * @param $id
     * @return mixed
     */
    public function resolve(ResolveTicketRequest $request, Ticket $ticket)
    {
        $ticket->resolver_id = auth()->user()->id;
        $ticket->resolved_at = Carbon::now();
        $ticket->save();

        return redirect()->route('tickets');
    }
}
