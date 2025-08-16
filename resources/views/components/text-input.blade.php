@props(['disabled' => false])
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
