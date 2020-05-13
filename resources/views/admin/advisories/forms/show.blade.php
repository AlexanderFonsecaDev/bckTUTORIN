@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Información de la asesoría
    </h1>
    <p class="mb-4">
        Los datos que se muestran aquí serán visibles para cualquier tutor que cuente con las habilidades requeridas.
    </p>

    <div class="row">
        <div class="col-md-8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Información necesaria para una asesoría</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-primary">Titulo : </h3>
                        <h3>{{ $advisory->title }}</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-primary">Precio x hora: </h3>
                        <h3>{{ $advisory->price }}</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-primary">Fecha de la asesoría : </h3>
                        <h3>{{ $advisory->delivery->format('M/d/Y') }}</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-primary">Horas : </h3>
                        <h3>{{ $advisory->hours }}</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-primary">Tipo : </h3>
                        @if($advisory->virtual == true)
                            <h3>Virtual</h3>
                        @else
                            <h3>A Domicilió </h3>
                        @endif
                    </div>
                    @if($advisory->virtual == false)
                        <div class="col-md-6">
                            <h3 class="text-primary">Zona : </h3>
                            <h3>{{ $advisory->zone->name }}</h3>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <h3 class="text-primary">Detalle : </h3>
                        <p>
                            {!! $advisory->body !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usuario que hizo la publicación.</h6>
                </div>
                <div class="card-body">
                    <h3 class="text-primary">Nombre : </h3>
                    <a class="text-muted font-weight-bold" href="{{ route('students.show',$advisory->user) }}">
                        <h3>
                            {{ $advisory->user->name }}
                        </h3>
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Archivos anexos.</h6>

                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            @if(!empty($advisory->image))
                                <img width="200" class="img-profile" src="{{ $advisory->image->url }}"
                                     alt="Foto de perfil del usario">
                            @endif
                        </div>
                        <div class="col-md-12">
                            @if(!empty($advisory->file))
                                <a href="{{ $advisory->file->url }}" target="_blank">
                                    <img width="100" src="/document.png" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de la asesoría </h6>
                </div>
                <div class="card-body">
                    <h5> Categoría :</h5>
                    <a href="{{ route('category.show',$advisory->category) }}">
                        <h6> {{ $advisory->category->name }} </h6>
                    </a>

                    <hr>
                    <h5> Nivel :</h5>
                    <a href="{{ route('level.show',$advisory->level) }}">
                        <h6> {{ $advisory->level->name }} </h6>
                    </a>
                    <hr>
                    @foreach($advisory->tags as $tag)
                        <a href="{{ route('tag.show',$tag) }}">
                            <span class="text-muted"> # {{ $tag->name }}</span>
                        </a>

                    @endforeach
                </div>
            </div>

        </div>
    </div>

    @if( !empty($advisory->offers))
        @foreach($advisory->offers as $offer)
            <div class="card border-left-success shadow h-100 py-2 mt-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold mb-1">
                                <a href="{{ route('students.show',$offer->user) }}">
                                    <h3 class="text-success">{{ $offer->user->name }}</h3>
                                </a>
                                <p>{{ $offer->body }}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $offer->price }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                    <a href="#" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                        <span class="text">Aceptar propuesta</span>
                    </a>

                    <form method="POST"
                          action="{{ route('offer.delete', $offer) }}"
                          style="display: inline">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button class="float-right btn btn-danger btn-icon-split"
                                onclick="return confirm('¿Estás seguro de querer eliminar esta oferta?')"
                        ><span class="text">Eliminar Propuesta</span></button>
                    </form>


                </div>
            </div>
        @endforeach
    @endif


@endsection
