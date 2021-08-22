@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row d-flex justify-content-center mt-3">
        <div class="col-md-3 col-10 mt-5">
            <div id="foto">
                <img class="card-img-bottom" src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="Card image cap">
            </div>
        </div>
        <div class="col-md-7 col-10 mt-5">
            <div class="card w-90">
                <div class="card-body">
                    <h5 class="card-title">{{$movie['original_title']}}</h5>
                    <p>  
                    @foreach ($movie["genres"] as $genre)
                    
                            {{$genre['name']}}@if(!$loop->last), @endif
                    
                    @endforeach
                    </p>
                    <hr>
                    <p class="card-text">{{$movie['overview']}}</p>
                    <p>Lançamento: {{\Carbon\Carbon::parse($movie['release_date'])->format('d/m/Y')}}<p>
                    <p>Elenco:</p>    
                    <span class="font-weight-light">
                        @foreach ($movie['credits']['cast'] as $cast)
                            @if($loop->index <5)
                                {{$cast['name']}},
                            @endif  
                        @endforeach  
                        <br><br>  
                    <span>
                        
                    <p class="font-weight-normal">Direção:</p> 
                    <span class="font-weight-light">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if($loop->index <2)
                                {{$crew['name']}},
                            @endif  
                        @endforeach     
                    <span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection