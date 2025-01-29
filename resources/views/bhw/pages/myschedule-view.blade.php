@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Schedule Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $myschedule->name }}</h5>
            <p class="card-text"><strong>Date of Delivery:</strong> {{ $myschedule->date_of_delivery }}</p>
            <p class="card-text"><strong>Time of Visit:</strong> {{ $myschedule->time_of_visit }}</p>
            <p class="card-text"><strong>Remarks:</strong> {{ $myschedule->remarks }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $myschedule->already_visited ? 'Already Visited' : 'Pending' }}</p>
            <a href="{{ route('myschedules.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection