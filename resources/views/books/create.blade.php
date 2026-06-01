<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Add Book</h1>
            <flux:button :href="route('books.index')" wire:navigate>Back</flux:button>
        </div>

        <div class="max-w-lg rounded-xl border border-neutral-200 p-6 dark:border-neutral-700">
            <form method="POST" action="{{ route('books.store') }}" class="flex flex-col gap-4">
                @csrf

                <flux:input label="Title" name="title" :value="old('title')" required />
                <flux:input label="Author" name="author" :value="old('author')" required />
                <flux:input label="Quantity" name="quantity" type="number" :value="old('quantity', 1)" required min="0" />

                <div class="flex justify-end gap-2">
                    <flux:button :href="route('books.index')" variant="ghost" wire:navigate>Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Save</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>