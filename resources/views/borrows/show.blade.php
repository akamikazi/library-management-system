<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Borrow Record</h1>
            <div class="flex gap-2">
                <flux:button :href="route('borrows.edit', $borrow)" icon="pencil" wire:navigate>Edit</flux:button>
                <flux:button :href="route('borrows.index')" wire:navigate>Back</flux:button>
            </div>
        </div>

        <div class="max-w-lg rounded-xl border border-neutral-200 p-6 dark:border-neutral-700">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Student</dt>
                    <dd class="font-medium">
                        <a href="{{ route('students.show', $borrow->student) }}" class="hover:underline" wire:navigate>{{ $borrow->student->name }}</a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Book</dt>
                    <dd class="font-medium">
                        <a href="{{ route('books.show', $borrow->book) }}" class="hover:underline" wire:navigate>{{ $borrow->book->title }}</a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Borrow Date</dt>
                    <dd class="font-medium">{{ $borrow->borrow_date->format('M d, Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-neutral-500 dark:text-neutral-400">Return Date</dt>
                    <dd class="font-medium">{{ $borrow->return_date?->format('M d, Y') ?? 'Not returned yet' }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-layouts.app>