@extends('layouts.app')
@section('content')
<div class="panel-body">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="task" class="col-sm-3 control-label">Новость</label>
        <div class="col-sm-6">
            <table class="table table-striped task-table">
                <thead>
                    <tr>
                        <th>{{$news->name}}</th>
                    </tr>         
                </thead>
                <tbody>
                    <tr>
                        <td class="table-text">{{$news->text}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <a href="/news">
                <button type="button" class="btn btn-primary bg-danger">
                    <i class="fa fa-primary"></i> Домой
                </button> 
            </a>
        </div>
    </div>
</div>
@endsection