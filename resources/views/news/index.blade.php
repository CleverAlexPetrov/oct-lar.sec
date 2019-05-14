@extends('layouts.app')
@section('content')
<!-- Bootstrap шаблон... -->
<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <!-- Форма новой задачи -->
    <form action="{{ url('news/create') }}" method="get" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-primary"></i> Добавить новость
                </button>
            </div>
        </div>
    </form>
</div>  
@if (count($news) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Список новостей
    </div>
    <div class="panel-body">
        <table class="table table-striped news-table">
            <thead>
                <tr>
                    <th>Название новости</th>
                    <th>Удаление</th>
                    <th>Редактирование</th>
                </tr>           
            </thead>
            <tbody>
                @foreach ($news as $news)
                <tr>
                    <td class="table-text">                   
                        <form action="{{ url('news/{news}') }}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            {{method_field('get')}}
                            <div>
                                <a href="news/show">
                                    {{ $news->name }}
                                    <input type="hidden" name="name" id="news-name" class="form-control">
                                </a>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="{{url('news/'.$news->id)}} " method="post">
                            {{csrf_field()}}
                            {{method_field('delete')}}
                            <button type="submit" class="btn btn-default bg-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('/news/'.$news->id.'/edit') }}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            {{method_field('get')}}
                            <button type="submit" class="btn btn-default bg-success">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection