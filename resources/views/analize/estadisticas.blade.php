@extends('layouts.app')

@section('content')

    @foreach ($resultsSet as $i)
        @dump($i)
    @endforeach

@endsection
