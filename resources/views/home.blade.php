@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div class="col-md-6">Todo App</div>              
                @guest  
                @else                  
                <div class="col-md-6">
                <div class="pull-right">
                   <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTodo">+ Add New Todo</a>
                </div>
                </div>
<div id="addTodo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add a todo</h4>
      </div>
      <div class="modal-body">
        <div class="">
            <div class="">
                {{Form::open(array('url' => 'add') )}}
                <div class="form-group ">
                    <label class="control-label" for="name">Title</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group ">
                    <label class="control-label" for="details">Todo Description</label>
                    <textarea class="form-control" name="details"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>                
                @endguest
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                    @endif
                    @if (Session::has('message'))
                       <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif                      
                    @guest
                    <!-- not logged in -->
                    <div class="alert alert-danger">Please Login to add your todo</div>
                    @else
                    <!-- logged in -->
                    <table class="table table-hovered" style="width:100%">
                      <tr>
                        <th>Task Name</th>
                        <th>Created by</th> 
                        <th class="pull-right">Action</th>
                      </tr>
                      @foreach($tasks as $task)
                      <tr>
                        <td>{{$task->title}}</td>
                        <td>{{$task->name}}</td> 
                        <td class="pull-right">
<div class="row">                            
    <a href="{{$task->tid}}" class="btn btn-sm btn-info padding5" data-toggle="modal" data-target="#edit{{$task->tid}}"> Edit </a> 
<div id="edit{{$task->tid}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{$task->title}}</h4>
      </div>
      <div class="modal-body">
        <div class="">
            <div class="">
                {{Form::open(array('url' => 'edit') )}}
                <div class="form-group ">
                    <label class="control-label" for="name">Title</label>
                    <input type="text" name="name" value="{{$task->title}}" class="form-control">
                    <input type="hidden" name="tid" value="{{$task->tid}}">
                </div>
                <div class="form-group ">
                    <label class="control-label" for="details">Todo Description</label>
                    <textarea class="form-control" name="details">{{$task->details}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {{Form::close()}}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>    
                     @if($task->completed == 1)
                     {{Form::open(array('url'=>'completed'))}}
                     <input type="hidden" name="tid" value="{{$task->tid}}">
                     <input type="hidden" name="mark" value="0">
                     <button type="submit" class="btn btn-sm btn-info padding5">Completed</button>
                     {{Form::close()}}
                     @else
                     {{Form::open(array('url'=>'completed'))}}
                     <input type="hidden" name="tid" value="{{$task->tid}}">
                     <input type="hidden" name="mark" value="1">
                     <button type="submit" class="btn btn-sm btn-warning padding5">Incomplete</button>
                     {{Form::close()}}
                     
                     @endif
                     <a href="{{url('delete')}}/{{$task->tid}}" class="btn btn-sm btn-danger padding5">Delete</a>
                 </div>
                 </td>
                       

                      </tr>
                      @endforeach
                    </table>

                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
