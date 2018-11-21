@extends('landing.master')

@section('body-class', 'bg-yellow')

@section('content')
    <div id="landing-gradinat-box" class="flex-col inline-flex p-6 rounded text-blue items-start">
        <h1 class="mb-4 text-4xl">Din nemmeste vej til en<br>  Digital Tilstedeværelse</h1>
        <p class="text-xl">
            Hjemmeside, Google Local Business, <br>
            Pæne Facebook Links og Seo. <br> 
            <b>på 5 minutter.</b>
        </p>
        <a class="btn my-12" href="{{ route('build.overview') }}">Byg din side</a>
    </div>
@endsection

