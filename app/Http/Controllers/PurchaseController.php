<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Purchase;
use App\Jobs\ProcessPurchaseJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function store(Request $request) {
        // Criar dados de teste para não haver erros de chaves estrangeiras
        $category = Category::firstOrCreate(['name' => 'Categoria Automatica', 'description' => 'Criada no teste']);
        
        $event = Event::firstOrCreate([
            'name' => 'Evento Automatico', 
            'category_id' => $category->id
        ], [
            'description' => 'Criado no teste',
            'event_date' => now()->addDays(10)
        ]);

        $ticket = Ticket::firstOrCreate([
            'type' => 'Geral', 
            'event_id' => $event->id
        ], [
            'price' => 50.00
        ]);

        // Criar a compra com estado "pendente"
        $purchase = Purchase::create([
            'user_id' => auth()->id(), // Pega o utilizador do Token JWT
            'ticket_id' => $ticket->id,
            'payment_type' => 1,
            'payment_status' => 'pending'
        ]);

        // Enviar o Job para a fila (onde vai simular os 2 segundos e mudar para approved)[cite: 178]
        ProcessPurchaseJob::dispatch($purchase->id);

        return response()->json([
            'message' => 'Compra criada com sucesso e enviada para a fila de processamento.',
            'purchase' => $purchase
        ], 201);
    }

    public function details($id) {
        $purchase = Purchase::find($id);
        
        if (!$purchase) {
            return response()->json(['message' => 'Compra não encontrada'], 404);
        }

        return response()->json($purchase);
    }
}