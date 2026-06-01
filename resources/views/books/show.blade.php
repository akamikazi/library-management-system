<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">{{ $book->title }}</h1>
            <div class="flex gap-2">
                <flux:button :href="route('books.edit', $book)" icon="pencil" wire:navigate>Edit</flux:button>
                <flux:button :href="route('books.index')" wire:navigate>Back</flux:button>
            </div>
        </div>

        <div class="max-w-lg rounded-xl border border-neutral-200 p-6 dark:border-neutral-700">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Title</dt>
                    <dd class="font-medium">{{ $book->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Author</dt>
                    <dd class="font-medium">{{ $book->author }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Quantity</dt>
                    <dd class="font-medium">{{ $book->quantity }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Created</dt>
                    <dd class="font-medium">{{ $book->created_at->format('M d, Y') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-layouts.app>