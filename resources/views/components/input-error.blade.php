@props(['messages'])

@if ($messages)
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
