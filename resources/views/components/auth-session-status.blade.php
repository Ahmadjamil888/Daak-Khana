@props(['status'])
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
