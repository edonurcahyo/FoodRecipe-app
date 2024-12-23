@extends('layout')

@section('content')
    <h1>Recipes</h1>
    <a href="{{ route('recipes.create') }}">Add New Recipe</a>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <ul>
    @foreach ($recipes as $recipe)
        <li>
            @if ($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" width="100">
            @endif
            <h2>{{ $recipe->name }}</h2>
            <p>{{ $recipe->description }}</p>
            <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>
        </li>
    @endforeach
</ul>

@endsection
