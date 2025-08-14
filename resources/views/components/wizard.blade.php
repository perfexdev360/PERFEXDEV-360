@props(['steps' => 3])

<div x-data="{ step: 1, max: {{ $steps }} }">
    <div x-show="step === 1">
        {{ $step1 ?? '' }}
    </div>
    <div x-show="step === 2">
        {{ $step2 ?? '' }}
    </div>
    <div x-show="step === 3">
        {{ $step3 ?? '' }}
    </div>
    <div class="mt-4 flex justify-between">
        <button x-show="step > 1" @click="step--" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded">Back</button>
        <button x-show="step < max" @click="step++" class="ml-auto px-4 py-2 bg-blue-600 text-white rounded">Next</button>
    </div>
</div>
