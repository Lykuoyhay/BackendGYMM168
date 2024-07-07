@extends('layouts.master')

@section('title', 'Profile')

@section('content')

<div class="container-fluid px-4">
    <div class="py-5 mb-3 sm:p-8 shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="pt-5 sm:p-8 shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>
@stop
