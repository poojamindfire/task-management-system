<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Group') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-end">
            @if (session('task-group-status'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400 ml-4">{{ session('task-group-status') }}</p>
            @elseif (session('task-group-error'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400 ml-4">{{ __('Task group already exist or something went wrong.') }}</p>
            @elseif(session('task-group-delete-error'))
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400 ml-4">{{ session('task-group-delete-error') }}</p>

            @endif

            <!-- Button to add task group -->
            @include('tasks.partials.add-task-group-form')
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <!-- Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <!-- Table header and body -->
                    <thead class="bg-green-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        <!-- Check if task groups array is empty -->
                        @if ($taskGroups->isEmpty())
                        <tr>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-gray-500">No task groups found.</span>
                            </td>
                        </tr>
                        @else
                        <!-- Loop through task groups -->
                        @foreach ($taskGroups as $taskGroup)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- Replace with actual ID -->
                                {{ $taskGroup->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- Replace with actual name -->
                                {{ $taskGroup->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <!-- Add Task Button -->
                                    <form method="POST" action="{{ route('add-tasks') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="selected_task_group_id" value="{{ $taskGroup->id }}">
                                        <x-primary-button type="submit">{{ __('Add Task') }}</x-primary-button>
                                    </form>
                                    <!-- Update Button -->
                                    @include('tasks.partials.update-task-group-form', ['taskGroup' => $taskGroup])
                                    <!-- Delete Button -->
                                    @include('tasks.partials.delete-task-group-form', ['taskGroup' => $taskGroup])
                                </div>
                            </td>
                        </tr>
                        <!-- End loop -->
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>