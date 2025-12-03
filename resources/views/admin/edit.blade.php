<x-app-layout class="text-white">
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">Edit Challenge</h2>
    </x-slot>
    <div class="max-w-4xl mx-auto p-6">

        @if(session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-6 text-red-700 bg-red-100 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.update', $challenge) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- TITLE --}}
            <div>
                <label class="font-semibold text-white">Title</label>
                <input name="title" value="{{ old('title', $challenge->title) }}"
                       class="w-full border border-gray-300 rounded p-2 text-black" required>
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="font-semibold text-white">Description</label>
                <textarea name="description" class="w-full border border-gray-300 rounded p-2 text-black" rows="5"
                          required>{{ old('description', $challenge->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DIFFICULTY --}}
            <div>
                <label class="font-semibold text-white">Difficulty</label>
                <select name="difficulty_id" class="w-full border border-gray-300 rounded p-2 text-black">
                    @foreach($difficulties as $difficulty)
                        <option
                            value="{{ $difficulty->id }}" {{ old('difficulty_id', $challenge->difficulty_id) == $difficulty->id ? 'selected' : '' }}>
                            {{ $difficulty->difficulty }}
                        </option>
                    @endforeach
                </select>
                @error('difficulty_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label class="font-semibold text-white">Image</label>

                {{-- Show current image if exists --}}
                @if($challenge->image)
                    <div class="mb-3">
                        <p class="text-sm text-gray-300 mb-1">Current Image:</p>
                        <img src="{{ asset('storage/' . $challenge->image) }}" alt="Current Challenge Image"
                             class="w-32 h-32 object-cover rounded">
                    </div>
                @endif

                <input type="file" name="image" accept="image/*"
                       class="w-full text-gray-700 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="text-sm text-gray-400 mt-1">Leave empty to keep current image</p>
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- OPTIONAL BADGE --}}
            <div>
                <label class="font-semibold text-white">Badge</label>
                <select name="badge_id" class="w-full border border-gray-300 rounded p-2 text-black">
                    <option value="">None</option>
                    @foreach($badges as $badge)
                        <option value="{{ $badge->id }}" {{ old('badge_id', $challenge->badge_id) == $badge->id ? 'selected' : '' }}>
                            {{ $badge->name }}
                        </option>
                    @endforeach
                </select>
                @error('badge_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PUBLISHED --}}
            <div class="flex items-center">
                <label class="font-semibold flex items-center gap-2 text-white">
                    <input type="checkbox" name="published" value="1" {{ old('published', $challenge->published) ? 'checked' : '' }}>
                    Published
                </label>
                @error('published')
                <p class="text-red-500 text-sm mt-1 ml-4">{{ $message }}</p>
                @enderror
            </div>

            {{-- Duration --}}
            <div>
                <label class="font-semibold text-white">Duration (HH:MM)</label>
                <input name="duration" type="text" value="{{ old('duration', $challenge->duration) }}"
                       class="w-full border border-gray-300 rounded p-2 text-black" placeholder="01:30" required>
                @error('duration')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TOGGLE FOR STEPS --}}
            <div>
                <label class="font-semibold flex items-center gap-2 text-white">
                    <input type="checkbox" id="hasSteps" {{ (old('steps') || $challenge->steps->count() > 0) ? 'checked' : '' }}>
                    This challenge has steps
                </label>
            </div>

            {{-- STEPS CONTAINER --}}
            <div id="stepsContainer" class="{{ (old('steps') || $challenge->steps->count() > 0) ? '' : 'hidden' }} space-y-4">

                <h3 class="font-bold text-lg text-white">Steps</h3>

                {{-- BESTAANDE STEPS --}}
                @php
                    $existingSteps = $challenge->steps->sortBy('order');
                @endphp

                @if($existingSteps->count() > 0)
                    <div class="space-y-4">
                        <h4 class="font-semibold text-white">Bestaande Steps:</h4>
                        @foreach($existingSteps as $index => $step)
                            <div class="step-item border border-gray-300 p-4 rounded">
                                <div class="step-header flex justify-between items-center mb-2">
                                    <span class="font-semibold text-white">Step {{ $index + 1 }}</span>
                                    <button type="button"
                                            class="remove-existing-step bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Remove
                                    </button>
                                </div>
                                <textarea name="steps[]" class="w-full border border-gray-300 rounded p-2 text-black"
                                          rows="3" required>{{ old('steps.' . $index, $step->step_description) }}
                                </textarea>

                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- NIEUWE STEPS SECTIE --}}
                <div class="mt-6 pt-6 border-t border-gray-600">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-semibold text-white">Nieuwe Steps Toevoegen:</h4>
                        <button type="button" id="addStep"
                                class="bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600 transition">
                            + Add Step
                        </button>
                    </div>

                    <div id="newStepsList" class="space-y-4">
                        {{-- Nieuwe steps worden hier toegevoegd via JavaScript --}}
                    </div>
                </div>

            </div>

            {{-- SUBMIT --}}
            <div class="flex space-x-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Update Challenge
                </button>

                {{-- Cancel button --}}
                <a href="{{ route('admin.show', $challenge) }}"
                   class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-200">
                    Cancel
                </a>
            </div>

        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const hasSteps = document.getElementById('hasSteps');
                const stepsContainer = document.getElementById('stepsContainer');
                const addStep = document.getElementById('addStep');
                const newStepsList = document.getElementById('newStepsList');
                let newStepCounter = 0;

                // Toon steps container als er steps zijn
                if (hasSteps.checked) {
                    stepsContainer.classList.remove('hidden');
                }

                // Toggle steps visibility
                hasSteps.addEventListener('change', () => {
                    stepsContainer.classList.toggle('hidden', !hasSteps.checked);
                    if (!hasSteps.checked) {
                        newStepsList.innerHTML = ''; // Verwijder alleen nieuwe steps
                        newStepCounter = 0;
                    }
                });

                // Remove functionaliteit voor bestaande steps
                document.querySelectorAll('.remove-existing-step').forEach(btn => {
                    btn.addEventListener('click', function () {
                        if (confirm('Weet je zeker dat je deze bestaande step wilt verwijderen?')) {
                            this.closest('.step-item').remove();
                        }
                    });
                });

                // Add nieuwe step button
                addStep.addEventListener('click', () => {
                    newStepCounter++;

                    const stepDiv = document.createElement('div');
                    stepDiv.classList.add('new-step-item', 'border', 'border-green-500', 'p-4', 'rounded');

                    stepDiv.innerHTML = `
                    <div class="step-header flex justify-between items-center mb-2">
                        <span class="font-semibold text-green-400">Nieuwe Step ${newStepCounter}</span>
                        <button type="button" class="remove-new-step bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                            Remove
                        </button>
                    </div>
                    <textarea name="steps[]" class="w-full border border-gray-300 rounded p-2 text-black" rows="3" required placeholder="Voer de nieuwe step beschrijving in..."></textarea>
                `;

                    newStepsList.appendChild(stepDiv);

                    // Add remove functionality voor deze nieuwe step
                    const removeBtn = stepDiv.querySelector('.remove-new-step');
                    removeBtn.addEventListener('click', function () {
                        this.closest('.new-step-item').remove();
                        updateNewStepNumbers();
                    });
                });

                // Update nieuwe step nummers na verwijderen
                function updateNewStepNumbers() {
                    const newSteps = newStepsList.querySelectorAll('.new-step-item');
                    newSteps.forEach((step, index) => {
                        const titleSpan = step.querySelector('.step-header span');
                        if (titleSpan) {
                            titleSpan.textContent = `Nieuwe Step ${index + 1}`;
                        }
                    });
                    newStepCounter = newSteps.length;
                }
            });
        </script>
    @endpush

</x-app-layout>
