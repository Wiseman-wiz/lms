@extends('layouts.app')

@section('content')
<div class="container profile ">

    @include('card-profile-teacher',[
    'tab' => 'subjects'
    ])

    <div class="spacer"></div>
    <div class="box">
        <div class="container">
            <div class="content">
                <a href="{{ action('TeacherController@subjectCreate') }}" class="button is-primary">Add Subject</a>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="columns is-multiline">
        @foreach ($subjects as $key => $subject)
        <div class="column is-3">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title min-height-65">
                        {{ $subject->title }}
                    </p>
                    <a class="card-header-icon">
                        <span class="icon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                </header>
                <div class="card-content">
                    <div class="content">
                        <p class="min-height-100">
                            {{ str_limit($subject->description,100) }}
                        </p>
                        <small>Last updated {{ $subject->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
                <footer class="card-footer">
                    <a href="{{ url( 'teacher/subject/' . $subject->id . '/lessons')  }}" class="card-footer-item">View</a>
                    <a href="{{ url( 'teacher/subject/' . $subject->id . '/edit' ) }}" class="card-footer-item">Edit</a>
                    <a href="{{ url( 'teacher/subject/' . $subject->id . '/delete' ) }}" class="card-footer-item btn-subject-delete">Delete</a>
                </footer>
            </div>
        </div>
        @endforeach
    </div>
    {{ $subjects->links() }}
</div>
@endsection
