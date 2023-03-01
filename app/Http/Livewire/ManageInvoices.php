<?php

namespace App\Http\Livewire;

use App\Actions\Invoice\CreateNewInvoice;
use App\Actions\Invoice\RemoveInvoice;
use App\Actions\Invoice\UpdateInvoice;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ManageInvoices extends Component
{
    public array $state = [
        'description' => '',
    ];

    public int|null $customerId = null;

    public string $password = '';

    public bool $showingCreatingForm = false;

    public bool $confirmingInvoiceDeletion = false;

    public int| null $invoiceBeingIdRemoval = null;

    public function createInvoice(CreateNewInvoice $creator)
    {
        $invoice = $creator->create($this->state, $this->customer);
        return redirect()->route('customer.invoice.lines', $invoice->target->id);
    }


    public function confirmInvoiceRemoval($invoiceId)
    {
        $this->invoiceBeingIdRemoval = $invoiceId;

        $this->confirmingInvoiceDeletion = true;
    }

    /**
     * @throws ValidationException
     */
    public function removeInvoice(RemoveInvoice $remover)
    {
        $this->resetErrorBag();

        if ($this->password !== 'delete') {
            throw ValidationException::withMessages([
                'password' => 'This password does not match',
            ]);
        }
        $remover->remove($this->invoiceBeingIdRemoval);

        $this->reset('confirmingInvoiceDeletion','invoiceBeingIdRemoval','password');
    }

    public function getCustomerProperty()
    {
        return Customer::find($this->customerId);
    }

    public function getInvoicesProperty()
    {
        return $this->customer->invoices;
    }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.manage-invoices',[
            'invoices' => $this->Invoices
        ]);
    }
}
