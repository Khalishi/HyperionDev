<div>
    <div class=" flex items-center justify-end">
        <x-button type="button" wire:click="$toggle('showingCreatingForm')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="ml-2">Add Customer</span>
        </x-button>
    </div>
    <div class="mt-3 overflow-x-auto relative sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Name
                </th>
                <th scope="col" class="py-3 px-6">
                    Username
                </th>
                <th scope="col" class="py-3 px-6">
                    Address
                </th>
                <th scope="col" class="py-3 px-6">
                    Password
                </th>
                <th scope="col" class="py-3 px-6">
                    Balance
                </th>
                <th scope="col" class="py-3 px-6">
                    Outstanding Balance
                </th>
                <th scope="col" class="py-3 px-6">
                    Created at
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($customers as $customer)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$customer->name}}
                    </th>
                    <td class="py-4 px-6">
                        {{$customer->username }}
                    </td>
                    <td class="py-4 px-6">
                        {{$customer->address}}
                    </td>
                    <td class="py-4 px-6 w-48">
                        <div  x-data="{ open: false }" class="flex items-center space-x-2">
                            <span x-show="!open">
                                 *******
                            </span>
                            <span x-show="open">
                                 {{$customer->password}}
                            </span>
                            <button x-show="!open" @click="open = true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                            <button x-show="open" @click="open = false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>

                    </td>
                    <td class="py-4 px-6">
                        {{$customer->payments->sum('amount')}}
                    </td>

                    <td class="py-4 px-6">
                        -{{$customer->invoices->sum('amount')}}
                    </td>

                    <td class="py-4 px-6">
                        {{$customer->created_at->format('F j, Y')}}
                    </td>
                    <td class="py-4 px-6 text-right">
                      <div class="flex items-center space-x-2">
                          <a href="{{route('customer.invoices',$customer->id)}}" class="font-medium text-gray-600 dark:text-blue-500 hover:underline">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                              </svg>
                          </a>
                          <a href="{{route('customer.payments',$customer->id)}}" class="font-medium text-gray-600 dark:text-blue-500 hover:underline">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                              </svg>
                          </a>
                          <button wire:click="confirmCustomerUpdate({{$customer->id}})"  class="font-medium text-gray-600 dark:text-blue-500 hover:underline">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                              </svg>
                          </button>
                          <button wire:click="confirmCustomerRemoval({{$customer->id}})"  class="font-medium text-red-600 dark:text-blue-500 hover:underline">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                          </button>
                      </div>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" colspan="12" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <p>No customers</p>
                    </th>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

    <form wire:submit.prevent="{{ $customerBeingEdited ? 'updateCustomer' : 'createCustomer'  }}">
        <x-dialog-modal wire:model="showingCreatingForm">
            <x-slot name="title">
                {{ $customerBeingEdited ? 'Edit ' : 'Create '  }} Customer
            </x-slot>

            <x-slot name="content">
                <div class="mt-3">
                    <x-label for="name" value="Name" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div class="mt-3">
                    <x-label for="username" value="Username" />
                    <x-input id="username" type="text" class="mt-1 block w-full" wire:model.defer="state.username" />
                    <x-input-error for="username" class="mt-2" />
                </div>
                <div class="mt-3">
                    <x-label for="address" value="Address" />
                    <x-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" />
                    <x-input-error for="address" class="mt-2" />
                </div>
                <div class="mt-3">
                    <x-label for="password" value="Password" />
                    <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" />
                    <x-input-error for="password" class="mt-2" />
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
    <x-dialog-modal wire:model="confirmingCustomerDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your customer? Once your customer is deleted,
            all of its resources and data will be permanently deleted.
            Please type <span class="text-red-600">delete</span> to confirm you would like
            to permanently delete your customer.

            <div class="mt-4" x-data="{}"
                 x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-input type="password" class="mt-1 block w-3/4"
                             placeholder="type delete"
                             x-ref="password"
                             wire:model.defer="password"
                             wire:keydown.enter="removeCustomer" />

                <x-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingCustomerDeletion')" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="removeCustomer" wire:loading.attr="disabled">
                Delete Customer
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
