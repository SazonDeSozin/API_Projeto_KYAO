<?php
namespace App\Repositories;
use App\Models\Event;

class EventRepository
{
    public function getAll() {
        return Event::all();
    }

    public function findById($id) {
        return Event::find($id);
    }

    public function store($data) {
        return Event::create($data);
    }

    public function update($id, $data) {
        $event = Event::find($id);
        if($event) {
            $event->update($data);
        }
        return $event;
    }

    public function delete($id) {
        $event = Event::find($id);
        if($event) {
            $event->delete();
        }
        return $event;
    }
}