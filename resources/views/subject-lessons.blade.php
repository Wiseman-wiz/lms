@extends('layouts.app')

@section('content')
    <div class="container subjects ">
        <div class="box content">
            <!-- Main container -->
            <h1 class="title is-block has-text-centered">{{ $subject->title }}</h1>
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>{{ $lessons->total() }}</strong> lessons
                        </p>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <p class="control has-addons">
                            <input class="input" type="text" placeholder="Find a lesson">
                            <button class="button">
                                Search
                            </button>
                        </p>
                    </div>
                </div>
            </nav>
        </div>
        <div class="columns is-multiline">
            @foreach ($lessons as $key => $lesson)
                <div class="column is-6">
                    <div class="box notification {{ [
                        'is-warning',
                        'is-info',
                        'is-success',
                        'is-danger',
                        'is-primary'
                        ][$key%5] }}">
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-128x128">
                                    <img src="{{ $lesson->imagepath }}" alt="Image">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <a href="{{ url('lesson/'.$lesson->id) }}"><strong>{{ $lesson->title }}</strong></a> <small style="float:right;">{{ $lesson->updated_at->diffForHumans() }}</small>
                                        <br>
                                        {{ str_limit($lesson->description,200) }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>

        @if($lessons->hasPages())
            <div class="box">
                {{ $lessons->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
