@extends('template.master')

@section('content')
    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="brand">Brand</label>
        <input type="text" name="brand" id="brand" required>

        <label for="model">Model</label>
        <select name="model" id="model" required>
            <option value="suv">SUV</option>
            <option value="mpv">MPV</option>
            <option value="hatchback">Hatchback</option>
            <option value="lcgc">LCGC</option>
            <option value="sedan">Sedan</option>
            <option value="coupe">Coupe</option>
            <option value="convertible">Convertible</option>
            <option value="pickup">Pickup</option>
            <option value="van">Van</option>
            <option value="wagon">Wagon</option>
        </select>

        <label for="year">Year</label>
        <select name="year" id="year" required>
            @for ($year = date('Y'); $year >= 2000; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
            @endfor
        </select>

        <label for="price">Price</label>
        <input type="number" name="price" id="price" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" required></textarea>
    
        <!-- Input untuk upload gambar -->
        <label for="front_view_image">Front View Image</label>
        <input type="file" name="front_view_image" id="front_view_image">

        <label for="back_view_image">Back View Image</label>
        <input type="file" name="back_view_image" id="back_view_image">

        <label for="left_view_image">Left View Image</label>
        <input type="file" name="left_view_image" id="left_view_image">

        <label for="right_view_image">Right View Image</label>
        <input type="file" name="right_view_image" id="right_view_image">

        <label for="interior_view_image">Interior View Image</label>
        <input type="file" name="interior_view_image" id="interior_view_image">
    
        <button type="submit">Save</button>
    </form>
@endsection