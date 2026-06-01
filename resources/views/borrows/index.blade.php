<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Borrows</h1>
            <flux:button :href="route('borrows.create')" icon="plus" wire:navigate>Add Borrow</flux:button>
        </div>

        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm">
                <thead class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">Student</th>
                        <th class="px-4 py-3 text-left font-medium">Book</th>
                        <th class="px-4 py-3 text-left font-medium">Borrow Date</th>
                        <th class="px-4 py-3 text-left font-medium">Return Date</th>
                        <th class="px-4 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($borrows as $borrow)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-zinc-800/50">
                            <td class="px-4 py-3">
                                <a href="{{ route('students.show', $borrow->student) }}" class="hover:underline" wire:navigate>{{ $borrow->student->name }}</a>
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('books.show', $borrow->book) }}" class="hover:underline" wire:navigate>{{ $borrow->book->title }}</a>
                            </td>
                            <td class="px-4 py-3">{{ $borrow->borrow_date->format('M d, Y') }}</td>
                            <td class="px-4 py-3">{{ $borrow->return_date?->format('M d, Y') ?? '—' }}</td>
                            <td class="px-4 py-3 text-right">
                                <flux:button size="sm" :href="route('borrows.edit', $borrow)" icon="pencil" wire:navigate></flux:button>
                                <form method="POST" action="{{ route('borrows.destroy', $borrow) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button size="sm" icon="trash" variant="danger" type="submit"></flux:button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-neutral-500">No borrow records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $borrows->links() }}
        </div>
    </div>
</x-layouts.app>