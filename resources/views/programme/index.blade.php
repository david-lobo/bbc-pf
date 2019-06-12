@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if ($page_id === 'app')
        <search></search>
        @else 
        @foreach ($results as $programme)
        <div class="media mb-3 border-bottom">
            <img class="mr-3" src="{{ $programme['image_url'] }}" alt="Card image cap">
            <div class="media-body">
                <h5 class="mt-0">{{ $programme['title'] }}</h5>
                <p>{{ $programme['short_synopsis'] }}</p>
            </div>
        </div>
        @endforeach
        @endif
        </div>
    </div>
</div>
@endsection
