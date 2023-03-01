<?php

namespace App\Http\Livewire;

use App\Actions\Payment\CreateNewPayment;
use App\Actions\Payment\RemovePayment;
use App\Actions\Payment\UpdatePayment;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ManagePayments extends Component
{
    public array $state = [
        'amount' => '',
    ];

    public string $password = '';

    public bool $showingCreatingForm = false;

    public int|null $customerId = null;
    public Payment|null $paymentBeingEdited = null;
    public int| null $paymentIdBeingIdRemoval = null;
    public bool $confirmingPaymentDeletion = false;

    public function createPayment(CreateNewPayment $creator)
    {
        $creator->create($this->state,$this->customer);
        $this->reset('state','showingCreatingForm');
    }

    public function confirmPaymentUpdate($paymentId)
    {
        $this->paymentBeingEdited = Payment::find($paymentId);

        $this->state = [
            'amount' => $this->paymentBeingEdited->amount,
        ];

        $this->showingCreatingForm = true;
    }

    public function updatePayment(UpdatePayment $updater)
    {
        $updater->update($this->state, $this->paymentBeingEdited);
        $this->reset('state','showingCreatingForm','paymentBeingEdited');
    }

    public function confirmPaymentRemoval($paymentId)
    {
        $this->paymentIdBeingIdRemoval = $paymentId;

        $this->confirmingPaymentDeletion = true;
    }

    /**
     * @throws ValidationException
     */
    public function removePayment(RemovePayment $remover)
    {
        $this->resetErrorBag();

        if ($this->password !== 'delete') {
            throw ValidationException::withMessages([
                'password' => 'This password does not match',
            ]);
        }
        $remover->remove($this->paymentIdBeingIdRemoval);

        $this->reset('confirmingPaymentDeletion','paymentIdBeingIdRemoval','password');
    }

    public function getCustomerProperty()
    {
        return Customer::find($this->customerId);
    }

    public function getPaymentsProperty()
    {
        return $this->customer->payments;
    }

    public function render()
    {
        return view('livewire.manage-payments', [
            'payments' => $this->payments
        ]);
    }
}
