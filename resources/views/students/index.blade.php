<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Students</h1>
            <flux:button :href="route('students.create')" icon="plus" wire:navigate>Add Student</flux:button>
        </div>

        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm">
                <thead class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">Name</th>
                        <th class="px-4 py-3 text-left font-medium">Class</th>
                        <th class="px-4 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($students as $student)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-zinc-800/50">
                            <td class="px-4 py-3">
                                <a href="{{ route('students.show', $student) }}" class="hover:underline" wire:navigate>{{ $student->name }}</a>
                            </td>
                            <td class="px-4 py-3">{{ $student->class }}</td>
                            <td class="px-4 py-3 text-right">
                                <flux:button size="sm" :href="route('students.edit', $student)" icon="pencil" wire:navigate></flux:button>
                                <form method="POST" action="{{ route('students.destroy', $student) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button size="sm" icon="trash" variant="danger" type="submit"></flux:button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-neutral-500">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $students->links() }}
        </div>
    </div>
</x-layouts.app>