<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-gray-700 rounded-2xl shadow">
        <h2 class="text-2xl font-bold mb-6">Alle badges</h2>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
            @foreach($allBadges as $badge)
                <div class="w-28 h-28 rounded-full border flex items-center justify-center
                    <img src="{{ $badge->image }}" alt="{{ $badge->name }}" class="w-full h-full object-cover">
        </div>
        @endforeach
    </div>
</x-app-layout>
