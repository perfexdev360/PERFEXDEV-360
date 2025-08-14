<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 dark:divide-gray-700']) }}>
    <thead class="bg-gray-50 dark:bg-gray-700">
        {{ $head ?? '' }}
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
        {{ $slot }}
    </tbody>
</table>
