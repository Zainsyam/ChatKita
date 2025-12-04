<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div>
            <flux:heading size="xl" level="1">{{ __('Dashboard') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">{{ __('selamat datang') }} {{ auth()->user()->name }}</flux:subheading>
            <flux:separator variant="subtle" />
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="absolute inset-0 size-full flex items-center justify-center">
                <span class="text-sm text-neutral-500 dark:text-neutral-400">{{ __('Fitur dashboard akan segera hadir!') }}</span>
            </div>
        </div>
    </div>
</x-layouts.app>
