@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                        <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question <i class="fa fa-question"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')

                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes_count }}</strong> {{ str_plural('vote' , $question->votes_count) }}
                                </div>
                                <div class="status {{ $question->status }}">
                                    <strong>{{ $question->answers_count }}</strong> {{ str_plural('answer' , $question->answers_count) }}
                                </div>
                                <div class="view">
                                    {{ $question->views. " " . str_plural('view' , $question->views) }}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                                    <div class="ml-auto">
                                        @if (auth::user('type', 2))
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit <i class="fa fa-pencil-alt"></i></a>
                                            <form class="form-delete" method="post" action="{{ route('questions.destroy', $question->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete <i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            <p class="lead">
                            Asked by <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                            <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            {{-- {{ str_limit($question->body, 250) }} --}}
                            {{-- For HTML TAGS REMOVAL BELOW CODE--}}
                            {{ str_limit(strip_tags($question->body_html), 300) }}
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <div class="">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
