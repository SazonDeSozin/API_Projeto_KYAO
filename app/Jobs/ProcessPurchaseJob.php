<?php

namespace App\Jobs;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPurchaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $purchaseId;

    public function __construct($purchaseId)
    {
        $this->purchaseId = $purchaseId;
    }

    public function handle(): void
    {
        Log::info('Job iniciado para a compra ID: ' . $this->purchaseId);
        
        $purchase = Purchase::find($this->purchaseId);
        
        if ($purchase) {
            // Simulando um processamento demorado (ex: aprovação de cartão)
            sleep(2); 
            
            $purchase->payment_status = 'approved';
            $purchase->save();
            
            Log::info('Job concluído. Compra ' . $this->purchaseId . ' aprovada.');
        } else {
            Log::error('Job falhou. Compra não encontrada.');
        }
    }
}