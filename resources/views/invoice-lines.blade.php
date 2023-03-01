<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invoice: {{$invoice->description}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <livewire:manage-invoice-lines :invoice="$invoice" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
