@extends('layouts.app')

@section('css')
    <style>


    </style>
@endsection

@section('content')
<div id="hero-section">
    <div id="hero-section-content-wrapper" class="container">
        <div id="hero-message" class="text-center text-dark my-5">
            <h1>Bloggr</h1>
            <h5 class="mt-4">Learn new things.</h5>
        </div>

        <div id="latest-posts" class="row gx-5 d-flex align-items-stretch">

            <div class="row ms-2 px-2">
                <div class=" col-12 d-flex justify-content-between align-items-center">
                    <h1 class="text-dark my-3">Latest posts</h1>
                    <a class="text-primary me-2" href="{{ route('articles.index') }}" wire:navigate>View all &rightarrow;</a>
                </div>
            </div>
            <div class="col-12 col-sm-6 ">
                <img src="https://via.placeholder.com/1600x900" class="w-100" alt="">
            </div>
            <div class="col-12 col-sm-6 row">
                <div class="col-12 row">
                    <div class="col-3">
                        <img src="https://via.placeholder.com/600x400" class="w-100" alt="">
                    </div>
                    <div class="col-9">
                        <h5 class="text-primary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero, provident!</h5>
                        <div>
                            <span class="author bold">Author</span>
                            <span class="time-to-read text-muted px-3"><i class="fas fa-stopwatch me-2"></i>7 min read</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 row">
                    <div class="col-3">
                        <img src="https://via.placeholder.com/600x400" class="w-100" alt="">
                    </div>
                    <div class="col-9">
                        <h5 class="text-primary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero, provident!</h5>
                        <div>
                            <span class="author bold">Author</span>
                            <span class="time-to-read text-muted px-3"><i class="fas fa-stopwatch me-2"></i>7 min read</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 row">
                    <div class="col-3">
                        <img src="https://via.placeholder.com/600x400" class="w-100" alt="">
                    </div>
                    <div class="col-9">
                        <h5 class="text-primary">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero, provident!</h5>
                        <div>
                            <span class="author bold">Author</span>
                            <span class="time-to-read text-muted px-3"><i class="fas fa-stopwatch me-2"></i>7 min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
