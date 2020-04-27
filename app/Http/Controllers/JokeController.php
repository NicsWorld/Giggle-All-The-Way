<?php

namespace App\Http\Controllers;

use App\Joke;
use App\Events\JokeAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class JokeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $jokes = Joke::orderBy('created_at', 'desc')->get();
         return view('jokes.index')->with(compact('jokes'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    if (Auth::user()) {
      $joke = new Joke();

      return view('jokes.create')->with(compact('joke'));
      }
      else{
        return view('auth.register');
      }
    }

    public function actOnChirp(Request $request, $id)
{
    $action = $request->get('action');
    switch ($action) {
        case 'Like':
            Joke::where('id', $id)->increment('likes_count');
            break;
        case 'Unlike':
            Joke::where('id', $id)->decrement('likes_count');
            break;
    }
    broadcast(new JokeAction($id, $action))->toOthers();
    return '';
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body = $request->joke_body;

        $joke = Joke::create([
          'body' => $body,
          'user_id' => auth()->id()
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Joke  $joke
     * @return \Illuminate\Http\Response
     */
    public function show(Joke $joke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Joke  $joke
     * @return \Illuminate\Http\Response
     */
    public function edit(Joke $joke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Joke  $joke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Joke $joke)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Joke  $joke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Joke $joke)
    {
        //
    }
}
