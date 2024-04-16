@extends('Front_End.layout.main_desgin')
@section('title','Search For '.$formName)
@section('content')
@if($formName == 'flight')
<h1>Package Form</h1>
@elseif ($formName == 'package')
@include('Front_End.pages.search.packages.packagesearch')
@else
@include('Front_End.pages.search.hotelsearch.hotelsearch')
@endif
@endsection
