@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="joke-container">
                    @foreach ($jokes as $joke)
                      <div class="card my-joke">
                        <a href="{{ url('/users/$joke->user->id') }}"><h5 class="card-header">{{$joke->user->name}}<span>{{$joke->created_at->diffForHumans()}}</span></h5></a>
                        <div class="card-body">{{$joke->body}}</div>
                        <div class="card-footer text-muted">
                          <div class="container button-container">
                          <span id="likes-count-{{ $joke->id }}">{{ $joke->likes_count }}</span>
                          <img onclick="loveit(event);" data-chirp-id="{{ $joke->id }}" class="good-review act-button my-profile-button" src="/svg/appreciation.svg" />
                          <img onclick="hateit(event);" data-chirp-id="{{ $joke->id }}" class="bad-review act-button my-profile-button" src="/svg/bad-review.svg" />
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
@endsection
