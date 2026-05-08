@props([
    'isLast' => false
])

<td class="px-4 py-4 {{$isLast ? 'border-r-0' : 'border-r' }} border-t bg-white">
    {{ $slot }}
</td>
