<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Edit Student</h1>
            <flux:button :href="route('students.index')" wire:navigate>Back</flux:button>
        </div>

        <div class="max-w-lg rounded-xl border border-neutral-200 p-6 dark:border-neutral-700">
            <form method="POST" action="{{ route('students.update', $student) }}" class="flex flex-col gap-4">
                @csrf
                @method('PUT')

                <flux:input label="Name" name="name" :value="old('name', $student->name)" required />
                <flux:input label="Class" name="class" :value="old('class', $student->class)" required />

                <div class="flex justify-end gap-2">
                    <flux:button :href="route('students.index')" variant="ghost" wire:navigate>Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Update</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>