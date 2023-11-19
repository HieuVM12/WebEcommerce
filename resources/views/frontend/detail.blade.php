@extends('layouts.frontend')
@section('content')
    <livewire:frontend.product.view :product='$product' :productsRelated='$productsRelated' />
@endsection
