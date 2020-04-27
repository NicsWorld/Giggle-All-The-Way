 @extends('layouts.app')

@section('content')
@section('js')
<script>
    var updateChirpStats = {
        Like: function (chirpId) {
            document.querySelector('#likes-count-' + chirpId).textContent++;
        },

        Unlike: function(chirpId) {
            document.querySelector('#likes-count-' + chirpId).textContent--;
        }
    };


    var toggleButtonText = {
        Like: function(button) {
            button.textContent = "Unlike";
        },

        Unlike: function(button) {
            button.textContent = "Like";
        }
    };

    function loveit(event) {
      const chirpId = event.target.dataset.chirpId;
      const action = document.querySelector('#likes-count-' + chirpId).textContent;

      document.querySelector('#likes-count-' + chirpId).textContent++;
      axios.post('/jokes/' + chirpId + '/act',
          { action: 'Like' });
    }

    function hateit(event) {
      const chirpId = event.target.dataset.chirpId;
      const action = document.querySelector('#likes-count-' + chirpId).textContent;

      document.querySelector('#likes-count-' + chirpId).textContent--;
      axios.post('/jokes/' + chirpId + '/act',
          { action: 'Unlike' });
    }
    var actOnChirp = function (event) {
      var chirpId = event.target.dataset.chirpId;
      var action = event.target.textContent;
      console.log(action);
      toggleButtonText[action](event.target);
      updateChirpStats[action](chirpId);
      axios.post('/jokes/' + chirpId + '/act',
          { action: action });
    };
    Echo.channel('chirp-events')
          .listen('JokeAction', function (event) {
              console.log(event);
              var action = event.action;
              updateChirpStats[action](event.chirpId);
          });
</script>
@endsection
<div class="joke-container">
  @foreach ($jokes as $joke)
    <div class="card">
      <a href="{{ url('/users/'.$joke->user->id) }}"><h5 class="card-header">{{$joke->user->name}}<span>{{$joke->created_at->diffForHumans()}}</span></h5></a>
      <div class="card-body">{{$joke->body}}</div>
      <div class="card-footer text-muted">
        <div class="container button-container">
        <!-- <button onclick="actOnChirp(event);" data-chirp-id="{{ $joke->id }}">Like</button> -->
        <span id="likes-count-{{ $joke->id }}">{{ $joke->likes_count }}</span>
        <img onclick="loveit(event);" data-chirp-id="{{ $joke->id }}" class="good-review act-button" src="/svg/appreciation.svg" />
        <img onclick="hateit(event);" data-chirp-id="{{ $joke->id }}" class="bad-review act-button" src="/svg/bad-review.svg" />
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection
