@extends('layouts.app')

@section('content')
    
    <h1>おすすめ動画を投稿</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($post, ['route' => 'posts.store']) !!}

                <div class="form-group">
                    {!! Form::text('video_id', null, ['class'=>'video_class form-control', 'placeholder' => '動画リンク貼り付け']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '動画タイトル']) !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '4', 'wrap' => 'hard', 'placeholder' => '動画に対するコメント']) !!}
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

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection