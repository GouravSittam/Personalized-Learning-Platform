@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Lesson Header -->
        <div class="p-6 border-b">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $lesson->title }}</h1>
                    <p class="text-gray-600">{{ $lesson->description }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                        {{ $lesson->duration_in_minutes }} minutes
                    </span>
                    @if($lesson->is_preview)
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">
                            Preview
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Lesson Content -->
        <div class="p-6">
            @switch($lesson->content_type)
                @case('video')
                    <div class="aspect-w-16 aspect-h-9 mb-6">
                        <iframe 
                            src="{{ $lesson->content['video_url'] }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full h-full rounded-lg"
                        ></iframe>
                    </div>
                    @break

                @case('text')
                    <div class="prose max-w-none">
                        {!! $lesson->content['text_content'] !!}
                    </div>
                    @break

                @case('quiz')
                    <div class="space-y-6">
                        @foreach($lesson->content['questions'] as $index => $question)
                            <div class="border rounded-lg p-4">
                                <h3 class="font-semibold mb-2">Question {{ $index + 1 }}</h3>
                                <p class="mb-4">{{ $question['text'] }}</p>
                                <div class="space-y-2">
                                    @foreach($question['options'] as $option)
                                        <label class="flex items-center gap-2">
                                            <input 
                                                type="radio" 
                                                name="question_{{ $index }}" 
                                                value="{{ $option['id'] }}"
                                                class="text-blue-600"
                                            >
                                            <span>{{ $option['text'] }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @break
            @endswitch
        </div>

        <!-- Lesson Actions -->
        <div class="p-6 border-t">
            <div class="flex justify-between items-center">
                <div class="flex gap-4">
                    @if($lesson->section->course->sections->where('order', '<', $lesson->section->order)->count() > 0)
                        <a href="{{ route('lessons.show', $lesson->section->course->sections->where('order', '<', $lesson->section->order)->last()->lessons->last()) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            ← Previous Lesson
                        </a>
                    @endif
                </div>

                <div class="flex gap-4">
                    @auth
                        <button 
                            onclick="markAsComplete()"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors"
                        >
                            Mark as Complete
                        </button>
                    @endauth

                    @if($lesson->section->course->sections->where('order', '>', $lesson->section->order)->count() > 0)
                        <a href="{{ route('lessons.show', $lesson->section->course->sections->where('order', '>', $lesson->section->order)->first()->lessons->first()) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            Next Lesson →
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<script>
function markAsComplete() {
    fetch('{{ route('lessons.complete', $lesson) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            // Show success message
            alert('Lesson marked as complete!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to mark lesson as complete');
    });
}
</script>
@endauth
@endsection 