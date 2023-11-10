@props([
    'type' => 'success',
    'colors' =>[
        'danger'=> 'bg-red-500',
    ]

])

<div role="alert">
    <div class="{{ $colors[$type] }} text-white font-bold rounded-t px-4 py-2">
      {{ $title }}
    </div>
    <div class="border border-t-0 border-gray-400 rounded-b bg-gray-100 px-4 py-3 text-gray-700">
      <p>{{ $message }}</p>
      <p>{{ $slot }}</p>
    </div>
</div>
