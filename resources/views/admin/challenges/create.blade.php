<x-app-layout class="text-white">
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white">Create Challenge</h2>
    </x-slot>
    <div class="max-w-4xl mx-auto p-6">

        <form method="POST" action="{{ route('challenges.store') }}" class="space-y-6">
            @csrf

            {{-- TITLE --}}
            <div>
                <label class="font-semibold text-white">Title</label>
                <input name="title" class="w-full border rounded p-2" required>
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="font-semibold text-white">Description</label>
                <textarea name="description" class="w-full border rounded p-2" rows="5" required></textarea>
            </div>

            {{-- DIFFICULTY --}}
            <div>
                <label class="font-semibold text-white">Difficulty</label>
                <select name="difficulty_id" class="w-full border rounded p-2">
                    @foreach($difficulties as $difficulty)
                        <option value="{{ $difficulty->id }}">{{ $difficulty->difficulty }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Image --}}
            <div>
                <label class="font-semibold text-white">Image</label>
                <input type="file" name="image" accept="image/*"
                       class="text-white px-2 py-1 bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- OPTIONAL BADGE --}}
            <div>
                <label class="font-semibold text-white">Badge</label>
                <select name="badge_id" class="w-full border rounded p-2">
                    <option value="">None</option>
                    @foreach($badges as $badge)
                        <option value="{{ $badge->id }}">{{ $badge->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- PUBLISHED --}}
            <div>
                <label class="font-semibold flex items-center gap-2 text-white">
                    <input type="checkbox" name="published" value="1"> Publish
                </label>
            </div>

            {{-- Duration --}}
            <div>
                <label class="font-semibold text-white">Duration (HH:MM:SS)</label>
                <input name="duration" type="text" class="w-full border rounded p-2" placeholder="01:30:00" required>
            </div>


            {{-- TOGGLE FOR STEPS --}}
            <div>
                <label class="font-semibold flex items-center gap-2 text-white">
                    <input type="checkbox" id="hasSteps">
                    This challenge has steps
                </label>
            </div>


            {{-- STEPS CONTAINER --}}
            <div id="stepsContainer" class="hidden space-y-4">

                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-lg text-white">Steps</h3>
                    <button type="button" id="addStep" class="bg-green-500 text-white px-3 py-2 rounded">
                        + Add Step
                    </button>
                </div>

                <div id="stepsList"></div>
            </div>


            {{-- SUBMIT --}}
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Create Challenge
            </button>

        </form>
    </div>
    @push('scripts')
        document.addEventListener("DOMContentLoaded", () => {

        const hasSteps = document.getElementById('hasSteps');
        const stepsContainer = document.getElementById('stepsContainer');
        const addStep = document.getElementById('addStep');
        const stepsList = document.getElementById('stepsList');

        hasSteps.addEventListener('change', () => {
        stepsContainer.classList.toggle('hidden', !hasSteps.checked);
        });

        addStep.addEventListener('click', () => {
        const stepDiv = document.createElement('div');
        stepDiv.classList.add('step-item', 'border', 'p-4', 'rounded', 'mb-4');

        stepDiv.innerHTML = `
        <div class="step-header flex justify-between items-center mb-2">
            <span class="step-title font-semibold"></span>
            <button type="button" class="remove-step bg-red-500 text-white px-3 py-1 rounded">
                Remove
            </button>
        </div>
        <textarea name="steps[]" class="w-full border rounded p-2" rows="3" required></textarea>
        `;

        stepsList.appendChild(stepDiv);
        updateStepNumbers();

        const removeBtn = stepDiv.querySelector('.remove-step');
        removeBtn.addEventListener('click', function () {
        this.closest('.step-item').remove();
        updateStepNumbers();
        });
        });

        function updateStepNumbers() {
        const steps = stepsList.querySelectorAll('.step-item');
        steps.forEach((step, index) => {
        const stepNumber = index + 1;
        const titleSpan = step.querySelector('.step-title');
        if (titleSpan) {
        titleSpan.textContent = `Step ${stepNumber}`;
        }
        });
        }

        });
    @endpush

</x-app-layout>
