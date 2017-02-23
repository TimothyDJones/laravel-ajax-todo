<html>
	<head>
		<title>To Do List Application</title>
		<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
		<div class="container">
			<section id="data_section" class="todo">
				<ul class="todo-controls">
				<li><img src="/assets/img/add.png" width="14px" onClick="show_form('add_task');" /></li>
				</ul>

				<ul id="task_list" class="todo-list">
				@foreach ($todos as $todo)
					@if ($todo->status)
						<li id="{{$todo->id}}" class="done"><a href="#" class="toggle"></a><span id="span_{{$todo->id}}">{{$todo->title}}</span> <a href="#" onClick="delete_task('{{$todo->id}}');" class="icon-delete">Delete</a> <a href="#" onClick="edit_task('{{$todo->id}}', '{{$todo->title}}';" class="icon-edit">Edit</a></li>
					@else

						<li id="{{$todo->id}}"><a href="#" class="toggle" onClick="task_done('{{$todo->id}}');"></a><span id="span_{{$todo->id}}">{{$todo->title}}</span> <a href="#" onClick="delete_task('{{$todo->id}}');" class="icon-delete">Delete</a> <a href="#" onClick="edit_task('{{$todo->id}}', '{{$todo->title}}';" class="icon-edit">Edit</a></li>
					@endif
				@endforeach
				</ul>
			</section>
			<section id="form_section">
				<form id="add_task" class="todo" style="display:none">
					<input id="task_title" type="text" name="title" placeholder="Enter task name" value="" />

					<input id="task_description" type="text" name="description" placeholder="Enter task description (optional)" value="" />
					<button name="submit">Add Task</button>
				</form>

				<form id="edit_task" class="todo" style="display:none">
					<input id="edit_task_id" type="hidden" value="" />
					<input id="edit_task_title" type="text" name="title" value="" />
					<input id="edit_task_description" type="text" name="description" value="" />
					<button name="submit">Edit Task</button>
				</form>
			</section>
		</div>
		
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/todo.js" type="text/javascript"></script>
	</body>
</html>
