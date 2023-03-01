@props(['submit'])

<form wire:submit.prevent="{{ $submit }}">
    {{ $slot }}
</form>
