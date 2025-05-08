@extends('layouts.dashboard')
@section('content')
<section class="py-16 bg-white rounded-lg shadow-lg ">
    <h2 class="text-3xl font-bold text-pink-600 mb-6 text-center">{{ $$resource->title }}</h2>
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <div class="prose max-w-none text-gray-700">
                {!! $$resource->content !!}
            </div>
        </div>
        <div class="w-full h-[500px] rounded-lg overflow-hidden shadow-lg">
            <img src="{{ asset($$resource->file_path) }}" alt="{{ $$resource->file_name }}"
                class="w-full h-full object-cover object-center">
        </div>
    </div>
</section>
@endsection