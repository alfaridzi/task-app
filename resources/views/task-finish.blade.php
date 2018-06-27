@extends('layouts.app')

@section('content')


<script type="text/javascript">
     function editForm(number) {
        var task = $('#'+number).data().task;
        $("input[name='name'").val(task);
        $('#tambah').html('<i class="fa fa-btn fa-pencil"></i>Edit Task');
    }
</script>


    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            

            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Finish Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>Date Finished</th>
                            </thead>
                            <tbody>



                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <td class="table-text"><div>{{ $task->updated_at }}</div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else

                <p class="text-center">No finished task available</p>
            @endif
        </div>
    </div>
@endsection

@section('javascript')

@endsection