@extends('layouts.app')

@section('content')


<script type="text/javascript">
     function editForm(number) {
        var task = $('#'+number).data().task;
        $("input[name='name'").val(task);
        $('#tambah').html('<i class="fa fa-btn fa-pencil"></i>Edit Task');
        $('#cancel').remove();
        $('#tambah').after('<button onClick="cancelEdt()" id="cancel" type="button" class="btn btn-warning"><i class="fa fa-btn fa-times"></i>Cancel</button>')
        document.newtask.action = "{{url('/update')}}/" + number;
    }


    function cancelEdt() {
        $("input[name='name'").val('');
        $('#tambah').html('<i class="fa fa-btn fa-plus"></i>Add Task');
        $('#cancel').remove();
        document.newtask.action = "{{url('/task')}}/";
    }
</script>


    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal" name="newtask">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button id="tambah" type="submit" class="btn btn-default" style="margin-right:5px">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>



                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$task->id) }}" method="POST" >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button onClick="return confirm('are you sure you want to delete this data?')" type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>

                                                 <button type="button" id="{{$task->id}}" class="btn btn-primary" onClick="editForm({{ $task->id }})" data-task="{{ $task->name }}">
                                                    <i class="fa fa-btn fa-pencil"></i>Edit
                                                </button>


                                                 <a href="{{ url('task/finish/'.$task->id) }}"  id="{{$task->id}}" class="btn btn-success">
                                                    <i class="fa fa-btn fa-check"></i>Finish
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('javascript')

@endsection