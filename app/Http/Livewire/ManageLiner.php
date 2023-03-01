<?php

namespace App\Http\Livewire;

use App\Actions\PaymentLine\CreateNewInvoiceLine;
use App\Actions\PaymentLine\RemoveInvoiceLine;
use App\Actions\PaymentLine\UpdateInvoiceLine;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use Livewire\Component;

class ManageLiner extends Component
{
    public Invoice $invoice;

    public InvoiceLine|null $liner = null;

    public array $state = [
        'amount' => '',
        'description' => '',
    ];

    public function mount()
    {
        if ($this->liner) {
            $this->state = [
                'amount' => $this->liner->amount,
                'description' => $this->liner->description,
            ];
        }
    }

    public function createInvoiceLine(CreateNewInvoiceLine $creator)
    {
        $creator->create($this->state,$this->invoice);

        $this->emitTo('manage-invoice-lines', 'LineModified');

        $this->reset('state');
    }

    public function updateInvoiceLine(UpdateInvoiceLine $updater)
    {
        $updater->update($this->state,  $this->liner );

        $this->emitUp('LineModified');
    }

    public function removeInvoiceLine(RemoveInvoiceLine $remover)
    {
        $remover->remove($this->liner->id);

        $this->emitUp('LineModified');
    }

    public function render()
    {
        return view('livewire.manage-liner');
    }
}
