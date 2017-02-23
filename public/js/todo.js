function task_done(id) {
	$.get("/done/" + id, function(data) {
		if (data == "OK") {
			$("#" + id).addClass("done");
		}
	});
}

function delete_task(id) {
	$get("/delete/" + id, function(data) {
		if (data == "OK") {
			var target = $("#" + id);
			target.hide("slow", function() { target.remove(); });
		}
	});
}

function show_form(form_id) {
	$("form").hide();
	$("#" + form_id).show("slow");
}

function edit_task(id, title, description) {
	$("#edit_task_id").val(id);
	$("#edit_task_title").val(title);
	$("#edit_task_description").val(description);
	show_form('edit_task');	
}

$('#add_task').submit(function(event) {
	/* Prevent form from submitting normally. */
	event.preventDefault();

	var title = $('#task_title').val();
	var description = $('#task_description').val();
	if (title) {
		// Post form via Ajax
		$.post("/add",
			{title: title,
			 description, description}).done(function(data) {
				 $('#add_task').hide("slow");
				 $('#task_list').append(data);
			 });
	} else {
		alert("Please provide a title/name for the task.");
	}

});

$('#edit_task').submit(function(event) {
	/* Prevent form from submitting normally. */
	event.preventDefault();

	var task_id = $("#edit_task_id").val();
	var title = $("#edit_task_title").val();
	var current_title = $("#span_" + task_id).text();
	var new_title = current_title.replace(current_title, title);
	var description = $("#edit_task_description").val();
	if (title) {
		// Post update via Ajax
		$.post("/update/" + task_id, 
			{title: title,
			 description: description}).done(function() {
				$('#edit_task').hide("slow");
				$("#span_" + task_id).text(new_title);
			 });
	} else {
		alert("Please provide a title/name for the task.");
	}
});
