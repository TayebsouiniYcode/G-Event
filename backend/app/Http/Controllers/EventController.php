<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $eventData = $request->except('tickets');
        $event = Event::create($eventData);

        if ($request->has('tickets')) {
            foreach ($request->input('tickets') as $ticketData) {
                $event->tickets()->create($ticketData);
            }
        }

        return response()->json(['message' => 'Event created', 'event' => $event], 201);
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }


        return response()->json(['message' => 'Event found', 'event' => $event], 200);
    }

    public function update(Request $request, $id)
    {

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $eventData = $request->except(['tickets', 'address_id']);
        $event->update($eventData);

        if ($request->has('tickets')) {
            $event->tickets()->delete();
            foreach ($request->input('tickets') as $ticketData) {
                $event->tickets()->create($ticketData);
            }
        }

        $event->update($request->all());

        return response()->json(['message' => 'Event updated', 'event' => $event]);
    }

    public function destroy(Request $request)
    {
        $id =  $request->input("id");

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted'], 200);
    }
}
