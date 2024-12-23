@extends('layout')

@section('content')
    <h1>Add Recipe</h1>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="ingredients">Ingredients:</label>
        <textarea name="ingredients" id="ingredients" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image">

        <button type="submit">Submit</button>
    </form>

@endsection
