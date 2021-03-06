@extends('layouts.app')

@section('content')

    
    <div class="text-center">
        <h1>投稿内容を編集する</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::text('video_id', 'https://www.youtube.com/watch?v=' . $post->video_id, ['class'=>'video_class form-control', 'placeholder' => '動画リンク貼り付け']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '動画タイトル']) !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '4',  'placeholder' => '動画に対するコメント']) !!}
                    <div class="rating">
                        {{Form::radio('rating', '5', false, ['class'=>'rating__input hidden--visually', 'id'=>'5-star'])}}
                        <label class="rating__label" for="5-star" title="星5つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星5つ</span></label>
                        {{Form::radio('rating', '4', false, ['class'=>'rating__input hidden--visually', 'id'=>'4-star'])}}
                        <label class="rating__label" for="4-star" title="星4つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星4つ</span></label>
                        {{Form::radio('rating', '3', false, ['class'=>'rating__input hidden--visually', 'id'=>'3-star'])}}
                        <label class="rating__label" for="3-star" title="星3つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星3つ</span></label>
                        {{Form::radio('rating', '2', false, ['class'=>'rating__input hidden--visually', 'id'=>'2-star'])}}
                        <label class="rating__label" for="2-star" title="星2つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星2つ</span></label>
                        {{Form::radio('rating', '1', false, ['class'=>'rating__input hidden--visually', 'id'=>'1-star'])}}
                        <label class="rating__label" for="1-star" title="星1つ"><span class="rating__icon" aria-hidden="true"></span><span class="hidden--visually">星1つ</span></label>
                    </div>
                </div>
                @if (Auth::check())
                    {!! Form::submit('編集', ['class' => 'btn btn-primary']) !!}
                @endif
            {!! Form::close() !!}
        </div>
    </div>
@endsection

