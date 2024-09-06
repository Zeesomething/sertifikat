@extends('layouts.user')

@section('content')

<img src="{{ asset('images/training/' . $training->cover) }}" alt="" class="img-fluid" style="width: 100%;"  >

@endsection
