@extends('layouts.app')
@section('content')
<div class="panel-body">
    @include('common.errors')
    <form action="{{ url('/news/'.$news->id) }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        {{method_field('put')}}
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Новость</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="news-name" value="{{$news->name}}" class="form-control">
                <textarea type="text" name="text" id="news-text" class="form-control">{{$news->text}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary bg-danger">
                    <i class="fa fa-primary"></i> Сохранить
                </button>
            </div>
        </div>
    </form>
</div>
@endsection