<?php

namespace App\Http\Livewire;

use App\Actions\Customer\CreateNewCustomer;
use App\Actions\Customer\RemoveCustomer;
use App\Actions\Customer\UpdateCustomer;
use App\Models\Customer;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ManageCustomers extends Component
{
    public array $state = [
        'name' => '',
        'username' => '',
        'address' => '',
        'password' => '',
    ];

    public string $password = '';

    public bool $showingCreatingForm = false;

    public bool $confirmingCustomerDeletion = false;

    public Customer| null $customerBeingEdited = null;

    public int| null $customerBeingIdRemoval = null;

    public function createCustomer(CreateNewCustomer $creator)
    {
        $creator->create($this->state);
        $this->reset('state','showingCreatingForm');
    }

    public function confirmCustomerUpdate($customerId)
    {
        $this->customerBeingEdited = Customer::find($customerId);

        $this->state = [
            'name' => $this->customerBeingEdited->name,
            'username' => $this->customerBeingEdited->username,
            'address' => $this->customerBeingEdited->address,
            'password' => $this->customerBeingEdited->password,
        ];

        $this->showingCreatingForm = true;
    }

    public function updateCustomer(UpdateCustomer $updater)
    {
        $updater->update($this->state, $this->customerBeingEdited);
        $this->reset('state','showingCreatingForm','customerBeingEdited');
    }

    public function confirmCustomerRemoval($customerId)
    {
        $this->customerBeingIdRemoval = $customerId;

        $this->confirmingCustomerDeletion = true;
    }

    /**
     * @throws ValidationException
     */
    public function removeCustomer(RemoveCustomer $remover)
    {
        $this->resetErrorBag();

        if ($this->password !== 'delete') {
            throw ValidationException::withMessages([
                'password' => 'This password does not match',
            ]);
        }
        $remover->remove($this->customerBeingIdRemoval);

        $this->reset('confirmingCustomerDeletion','customerBeingIdRemoval','password');
    }

    public function getCustomersProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return Customer::with(['invoices','payments'])->get();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.manage-customers',[
            'customers' => $this->customers
        ]);
    }
}
