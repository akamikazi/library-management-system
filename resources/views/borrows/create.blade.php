<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Add Borrow Record</h1>
            <flux:button :href="route('borrows.index')" wire:navigate>Back</flux:button>
        </div>

        <div class="max-w-lg rounded-xl border border-neutral-200 p-6 dark:border-neutral-700">
            <form method="POST" action="{{ route('borrows.store') }}" class="flex flex-col gap-4">
                @csrf

                <flux:select label="Student" name="student_id" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->student_id }}" @selected(old('student_id') == $student->student_id)>{{ $student->name }} ({{ $student->class }})</option>
                    @endforeach
                </flux:select>

                <flux:select label="Book" name="book_id" required>
                    @foreach ($books as $book)
                        <option value="{{ $book->book_id }}" @selected(old('book_id') == $book->book_id)>{{ $book->title }} — {{ $book->author }} ({{ $book->quantity }} available)</option>
                    @endforeach
                </flux:select>

                <flux:input label="Borrow Date" name="borrow_date" type="date" :value="old('borrow_date', date('Y-m-d'))" required />
                <flux:input label="Return Date" name="return_date" type="date" :value="old('return_date')" />

                <div class="flex justify-end gap-2">
                    <flux:button :href="route('borrows.index')" variant="ghost" wire:navigate>Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Save</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>