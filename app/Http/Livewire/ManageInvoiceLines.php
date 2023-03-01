<?php

namespace App\Http\Livewire;

use App\Actions\Invoice\UpdateInvoice;
use Livewire\Component;

class ManageInvoiceLines extends Component
{

    public array $state = [
        'description' => '',
    ];

    public $invoice;

    protected $listeners = ['LineModified' => 'refreshComponent'];

    public function mount()
    {
        $this->state['description'] = $this->invoice->description;
    }

    public function updateInvoiceDescription(UpdateInvoice $updater)
    {
        $updater->update($this->state, $this->invoice);
    }

    public function refreshComponent()
    {
        $this->invoice->refresh();

        $this->invoice->update([
            'amount' => $this->invoiceLines->sum('amount')
        ]);

    }

    public function getCustomerProperty()
    {
        return $this->invoice->customer;
    }

    public function getInvoiceLinesProperty()
    {
        return $this->invoice->invoiceLines;
    }

    public function render()
    {
        return view('livewire.manage-invoice-lines');
    }
}
