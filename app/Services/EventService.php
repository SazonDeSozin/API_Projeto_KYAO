<?php
namespace App\Services;
use App\Repositories\EventRepository;

class EventService
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAll() {
        return $this->eventRepository->getAll();
    }

    public function findById($id) {
        return $this->eventRepository->findById($id);
    }

    public function store($data) {
        return $this->eventRepository->store($data);
    }

    public function update($id, $data) {
        return $this->eventRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->eventRepository->delete($id);
    }
}