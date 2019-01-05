@extends('layouts.show')

@section('pageName', 'Просмотр товара ' . $product->name)

@section('stylesSection')
    <link rel="stylesheet" href="{{ asset('public/css/carousel.css') }}">
@endsection

@section('urlEdit', url('/products/' . $product->id . '/edit'))
@section('urlDelete', url('/products/' . $product->id))

@section('displayFields')
    @if (Auth::check())
        <form method="post" action={{ url('/tobasket/' . $product->id) }}>
            @csrf
            <label for="countinput">Количество: </label>
            <input class="form-control" id="countinput" type="text" name="count"><br>
            <button class="btn btn-primary" type="submit">Заказать</button>
        </form>
        <div class="vspacer10px"></div>
    @endif
    @if ($discount > 0)
        <label>ТОВАР ПО АКЦИИ</label><br>
    @endif
    <label>id: {{ $product->id }}</label><br>
    <label>Наименование: {{ $product->name }}</label><br>
    <label>Описание: {{ $product->description }}</label><br>
    <label>Стоимоть: {{ $product->cost * (1 - $discount / 100) }}</label><br>
    <label>Оценка: {{ $product->rating }}</label><br>
    <label>Оценок всего: {{ $product->ratingcounter }}</label><br>
    <label>Тип товара: {{ $product->type }}</label><br>
    @if (Auth::check())
        <hr>
        <label>Оцените товар:</label><br>
        <form method="post" action={{ url('/products/' . $product->id . '/rating') }}>
            <div class="d-flex">
                @csrf
                <button class="btn btn-primary" type="submit" name="rating" value="1">1</button>
                <div class="hspacer10px"></div>
                <button class="btn btn-primary" type="submit" name="rating" value="2">2</button>
                <div class="hspacer10px"></div>
                <button class="btn btn-primary" type="submit" name="rating" value="3">3</button>
                <div class="hspacer10px"></div>
                <button class="btn btn-primary" type="submit" name="rating" value="4">4</button>
                <div class="hspacer10px"></div>
                <button class="btn btn-primary" type="submit" name="rating" value="5">5</button>
            </div>
        </form>
    @endif
    <hr>
    @if ($images->count() > 0)
        <!--Carousel Wrapper-->
        <div id="carousel" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel" data-interval=false>
            <!--Indicators-->
            <ol class="carousel-indicators">
                @for ($imageCount = 0; $imageCount < $images->count(); $imageCount++)
                    @if ($imageCount == 0)
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    @else
                        <li data-target="#carousel" data-slide-to={{ $imageCount }}></li>
                    @endif
                @endfor
            </ol>
            <!--/.Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
            <?
                $first = true;
            ?>
                @foreach ($images as $image)
                    @if ($first)
                        <div class="carousel-item active">
                        <?
                            $first = false;
                        ?>
                    @else
                        <div class="carousel-item">
                    @endif
                        <div class="view">
                            <img class="d-block w-100" src={{ asset('/public/images/' . $image->path) }} alt={{ $image->path }}>
                            <div class="mask rgba-black-light"></div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
        </div>
        <!--/.Carousel Wrapper-->
    @endif
    <hr>
    @if (Auth::check())
        Написать<br>
        <form name="commentcreate" action={{ url('/comments') }} method="post">
            @csrf
            <textarea class="form-control" name="text"></textarea><br>
            <input type="hidden" name="product" value="{{ $product->id }}">
            <input type="hidden" name="user" value="{{ Auth::id() }}">
            <button class="btn btn-primary" type="submit">Написать</button>
        </form>
        <hr>
    @endif
    Комментарии:<br>
    <hr>
    @foreach ($comments as $comment)
        <div class="card">
            <div class="card-header">
                <label>Пользователь: {{ $comment->userRec->name }}</label><br>
                <label>{{ $comment->created_at }}</label><br>
            </div>
            <div class="card-body">
                <label>{{ $comment->text }}</label><br>
            </div>
        </div>
        <div class="vspacer10px"></div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $comments->links() }}
    </div>
    <hr>
@endsection