<div {{ $attributes->merge(['class'=>'bg-purple-200 border border-gray-90 rounded p-1'])}}>
    {{-- output whatever is sorrounded in <x-card> --}}
    {{ $slot }}

</div>