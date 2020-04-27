<form action="{{ url('/jokes')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">

  <div class="form-group">
    <textarea class="form-control" name="joke_body" placeholder="Joke"></textarea>
    <small class="form-text text-muted">Explain your joke bloke</small>
  </div>

  </div>
  <button class="btn btn-primary" type="submit">Submit</button>
</form>
