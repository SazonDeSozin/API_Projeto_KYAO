<?php
namespace App\Http\Controllers;
use App\Services\EventService;
use App\Http\Requests\EventStoreRequest;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function get() {
        $events = $this->eventService->getAll();
        return EventResource::collection($events);
    }

    public function store(EventStoreRequest $request) {
        $data = $request->validated();
        $event = $this->eventService->store($data);
        return (new EventResource($event))->response()->setStatusCode(201);
    }

    public function details($id) {
        $event = $this->eventService->findById($id);
        if (!$event) return response()->json(['message' => 'Event not found'], 404);
        return new EventResource($event);
    }

    public function update(EventStoreRequest $request, $id) {
        $data = $request->validated();
        $event = $this->eventService->update($id, $data);
        if (!$event) return response()->json(['message' => 'Event not found'], 404);
        return new EventResource($event);
    }

    public function destroy($id) {
        $event = $this->eventService->delete($id);
        if (!$event) return response()->json(['message' => 'Event not found'], 404);
        return response()->json(['message' => 'Event deleted'], 202);
    }
}