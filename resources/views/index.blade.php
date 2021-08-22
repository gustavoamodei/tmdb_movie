@extends('layouts.app')
@section('content')
<h3 class="font-italic align-self-center d-flex justify-content-center mt-3">Filmes em Alta</h3>
<div class="row">
    @foreach ($movies as $movie)
    <div class="col-md-3 col-12">
        <div class="card mt-5">
            <img class="card-img-top" src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$movie['title']}}</h5>
                <p class="card-text">{{Str::substr($movie['overview'],0,90).'...' }}</p>
                <hr>
                <p class="card-text">Lançamento: {{\Carbon\Carbon::parse($movie['release_date'])->format('d/m/Y')}}</p>
                <div>
                    @foreach ($movie["genre_ids"] as $genre)
                        {{$genres->get($genre)}}@if(!$loop->last), @endif
                         
                    @endforeach
                </div>
                <a href="{{route('movie.show',$movie['id'])}}" class="btn btn-primary">detalhes</a>
            </div>
        </div>
    </div>

    @endforeach
   
</div>

@endsection