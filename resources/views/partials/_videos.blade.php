@if($showList)
    <div class="row">
        @forelse($videos as $index => $video)
            @if($index% 4 == 0)
                <div class="pt-4"></div>
            @endif
            <div class="col-3 ">
                <div class="card">
                    <img  class="card-img-top" src="{{ $video->thumbnail }}" alt="" width="{{$video->extra->width }}" height="{{$video->extra->height }}">

                    <div class="card-body module">
                        <h6 class="card-title">{{ $video->title }}</h6>
                        <p class="card-text">{{ $video->description }}</p>
                        <p class="card-text"><small><i>Publicado el {{ date("d-m-Y", strtotime($video->published_at)) }}</i></small></p>
                    </div>
                </div>
            </div>
        @empty
            <div class="pt-4"></div>

            <div class="col">
                @if(isset($errorConnection))
                    Se ha presentado un error de conexión.
                @else
                    No hay resultados encontrados
                @endif
            </div>
        @endforelse
    </div>
@endif
