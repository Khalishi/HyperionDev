<form  wire:submit.prevent="{{ $liner ? 'updateInvoiceLine' : 'createInvoiceLine'  }}">
    <div class="flex items-center space-x-2">
        <div>
            <x-label for="description" value="Description" />
            <x-input id="description" type="text" wire:model.defer="state.description" />
            <x-input-error for="description" class="mt-2" />
        </div>

        <div>
            <x-label for="amount" value="Amount" />
            <x-input id="amount" type="number" wire:model.defer="state.amount" />
            <x-input-error for="amount" class="mt-2" />
        </div>
        <div class="mt-4 flex items-center space-x-2">
            <x-button class="py-2.5" wire:loading.attr="disabled">
                {{ $liner ? 'Update' : 'Save'  }}
            </x-button>
            @if($liner)
                <x-danger-button wire:click="removeInvoiceLine" wire:loading.attr="disabled">
                    Remove
                </x-danger-button>
            @endif
        </div>
    </div>
</form>

