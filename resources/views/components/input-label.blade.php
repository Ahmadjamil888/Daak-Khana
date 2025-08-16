@props(['value'])
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
