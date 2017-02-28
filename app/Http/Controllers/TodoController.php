<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
	public $restful = true;

	public function index() {
		TodoController::getIndex();
	}
	
	public function getIndex() {
		$todos = Todo::all();
		return view("index")->with("todos", $todos);
	}

	public function postAdd() {
		if (Request::ajax()) {
			$todo = new Todo();
			$todo->title = Input::get("title");
			$todo->description = Input::get("description");
			$todo->save();
			$last_todo = $todo->id;
			$todos = Todo::whereId($last_todo)->get();
			return View::make("ajaxData")->with("todos", $todos);
		}
	}

	public function postUpdate($id) {
		if (Request::ajax()) {
			$task = Todo::find($id);
			$task->title = Input::get("title");
			$task->description = Input::get("description");
			$task->save();
			return "OK";
		}
	}

	public function getDelete($id) {
		if (Request::ajax()) {
			$todo = Todo::whereId($id)->first();
			$todo->delete();
			return "OK";
		}
	}

	public function getDone($id) {
		if (Request::ajax()) {
			$todo = Todo::find($id);
			$todo->status = 1;
			$todo->save();
			return "OK";
		}
	}
}
