<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Books</h1>
            <flux:button :href="route('books.create')" icon="plus" wire:navigate>Add Book</flux:button>
        </div>

        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm">
                <thead class="border-b border-neutral-200 bg-neutral-50 dark:border-neutral-700 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 text-left font-medium">Title</th>
                        <th class="px-4 py-3 text-left font-medium">Author</th>
                        <th class="px-4 py-3 text-center font-medium">Quantity</th>
                        <th class="px-4 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse ($books as $book)
                        <tr class="hover:bg-neutral-50 dark:hover:bg-zinc-800/50">
                            <td class="px-4 py-3">
                                <a href="{{ route('books.show', $book) }}" class="hover:underline" wire:navigate>{{ $book->title }}</a>
                            </td>
                            <td class="px-4 py-3">{{ $book->author }}</td>
                            <td class="px-4 py-3 text-center">{{ $book->quantity }}</td>
                            <td class="px-4 py-3 text-right">
                                <flux:button size="sm" :href="route('books.edit', $book)" icon="pencil" wire:navigate></flux:button>
                                <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button size="sm" icon="trash" variant="danger" type="submit"></flux:button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-neutral-500">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $books->links() }}
        </div>
    </div>
</x-layouts.app>