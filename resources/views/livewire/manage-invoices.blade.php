<div>
    <div>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900">
            Manage Invoices for {{$this->Customer->name}}
        </h1>
    </div>

    <div class=" flex items-center justify-end">
        <x-button type="button" wire:click="$toggle('showingCreatingForm')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="ml-2">Add Invoice</span>
        </x-button>
    </div>
    <div class="mt-3 overflow-x-auto relative sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    amount
                </th>
                <th scope="col" class="py-3 px-6">
                    description
                </th>
                <th scope="col" class="py-3 px-6">
                    created at
                </th>

                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($invoices as $invoice)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$invoice->amount }}
                    </th>
                    <td class="py-4 px-6">
                        <a class="text-indigo-600" href="{{route('customer.invoice.lines',$invoice->id)}}">
                            {{$invoice->description }}
                        </a>
                    </td>

                    <td class="py-4 px-6">
                        {{$invoice->created_at->format('F j, Y')}}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <button wire:click="confirmInvoiceRemoval({{$invoice->id}})"  class="font-medium text-red-600 dark:text-blue-500 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" colspan="12" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <p>No invoices</p>
                    </th>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

    <form wire:submit.prevent="createInvoice">
        <x-dialog-modal wire:model="showingCreatingForm">
            <x-slot name="title">
                Create Invoice
            </x-slot>

            <x-slot name="content">

                <div class="mt-3">
                    <x-label for="description" value="Description" />
                    <x-input id="description" class="block w-full" type="text" wire:model.defer="state.description" />
                    <x-input-error for="description" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showingCreatingForm')" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>

                <x-button class="ml-3" wire:loading.attr="disabled">
                    Save
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </form>

    <!-- Delete Customer Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingInvoiceDeletion">
        <x-slot name="title">
            Delete Invoice
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your Invoice? Once your invoice is deleted,
            all of its resources and data will be permanently deleted.
            Please type <span class="text-red-600">delete</span> to confirm you would like
            to permanently delete your invoice.

            <div class="mt-4" x-data="{}"
                 x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-input type="password" class="mt-1 block w-3/4"
                         placeholder="type delete"
                         x-ref="password"
                         wire:model.defer="password"
                         wire:keydown.enter="removeInvoice" />

                <x-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingInvoiceDeletion')" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="removeInvoice" wire:loading.attr="disabled">
                Delete Invoice
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
