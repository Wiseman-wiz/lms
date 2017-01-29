@extends('layouts.app')
@section('content')
    <div class="container profile ">

        @include('card-profile-parent',[
            'tab' => 'activity'
        ])

        <div class="spacer"></div>

        <div class="columns">
            <div class="column">
                <div class="box">
                    <!-- Styles -->
                    <style>
                    #chartdiv {
                        width: 100%;
                        height: 500px;
                    }
                    </style>
                    <!-- Resources -->
                    <script src="/amcharts/amcharts.js"></script>
                    <script src="/amcharts/radar.js"></script>
                    <script src="/amcharts/plugins/export/export.min.js"></script>
                    <link rel="stylesheet" href="/amcharts/plugins/export/export.css" type="text/css" media="all" />
                    <script src="/amcharts/themes/light.js"></script>

                    <!-- Chart code -->
                    <script>
                    var chart = AmCharts.makeChart( "chartdiv", {
                        "type": "radar",
                        "theme": "light",
                        "dataProvider": <?php

                            echo json_encode($student->grade->map(function($g){
                                return [
                                    'grade' => $g->grade,
                                    'title' => str_limit($g->subject->title,20)
                                ];
                            })->all());
                            ?>,
                            "startDuration": 0,
                            "graphs": [ {
                                "balloonText": "[[value]]%",
                                "bullet": "round",
                                "lineThickness": 2,
                                "fillAlphas": 0.3,
                                "valueField": "grade"
                            } ],
                            "categoryField": "title",
                            "export": {
                                "enabled": true
                            }
                        } );
                        </script>

                        <!-- HTML -->
                        <div class="content">
                            <h3 class="is-block has-text-centered">Student Grades per Subject</h3>
                            <div id="chartdiv"></div>
                        </div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="box">
                        @foreach ($activities as $key => $log)
                            <article class="media log">
                                <div class="media-left">
                                    <figure class="is-48x48">
                                        <span class="icon is-large">
                                            <?php
                                            switch ($log->type) {
                                                case 'quiz-take':   $icon = 'file-text-o'; break;
                                                case 'exam-take':   $icon = 'list'; break;
                                                case 'lesson-visit':   $icon = 'book'; break;
                                                case 'login':
                                                default:        $icon = 'user'; break;
                                            }
                                            ?>
                                            <i class="fa fa-{{ $icon }}"></i>
                                        </span>
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>You</strong> <small>{{ Auth::user()->email }}</small> <small style="float:right;" title="{{ $log->updated_at->format('F j, Y, g:i a') }}">{{ $log->updated_at->diffForHumans() }}</small>
                                            <br>
                                            {!! str_replace([
                                                'USER'
                                            ], [
                                                'You'
                                            ], $log->description) !!}
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    @if($activities->hasPages())
                        <div class="box">
                            {{ $activities->links('vendor.pagination.simple-bulma') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
