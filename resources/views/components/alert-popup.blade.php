@php
    $class = '';
    if ($type === 'success') {
        $class = 'border-green-600 text-green-800 bg-green-50 dark:bg-green-800 dark:text-green-400';
    } elseif ($type === 'error') {
        $class = 'border-red-600 text-red-800 bg-red-50 dark:bg-red-800 dark:text-red-400';
    } elseif ($type === 'warning') {
        $class = 'border-yellow-600 text-yellow-800 bg-yellow-50 dark:bg-yellow-800 dark:text-yellow-400';
    } elseif ($type === 'info') {
        $class = 'border-blue-600 text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400';
    }
@endphp

<div id="{{$type}}-popup" {{$attributes->merge(['class' => 'flex absolute right-10 top-20 z-50 border hidden items-center p-4 mb-4 rounded-lg ' . $class ])}}>
    <span class="sr-only">{{$type}}</span>
    <div class="popup-message ms-3 text-sm font-medium">

    </div>
    <button type="button" {{$attributes->merge(['class' => 'dismiss ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8' . $class])}} aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
