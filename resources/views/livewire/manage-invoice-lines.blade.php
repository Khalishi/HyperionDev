<div>
    <div class="flex items-center justify-between">
       <div class="flex items-center space-x-2">
           <a href="{{route('customer.invoices',$this->invoice->customer->id)}}">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
               </svg>
           </a>
           <h3 class="text-lg font-medium leading-6 text-gray-900">Invoices</h3>
       </div>
        <div>
            <p class="text-3xl tracking-tight text-gray-900">Total Amount: R{{$this->invoice->amount}}</p>
        </div>
    </div>

    <form wire:submit.prevent="updateInvoiceDescription">
        <div class="mt-3">
            <x-input id="description" type="text" class="block w-full" wire:model.defer="state.description" />
            <x-input-error for="description" class="mt-2" />
        </div>
        <div class="mt-3">
            <x-button class="ml-3" wire:loading.attr="disabled">
                Update invoice description
            </x-button>
        </div>
    </form>

    <div class="mt-6">
    @foreach($this->invoiceLines as $line)
        <livewire:manage-liner :liner="$line" :invoice="$this->invoice" :wire:key="$line->id"/>
    @endforeach
    </div>

    <div class="mt-3">
        <livewire:manage-liner :invoice="$invoice" />
    </div>

</div>
