
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
class TasksController extends Controller
{
public function index()
{
$tasks = Task::all();
return response()->json($tasks);
}
public function store(Request $request)
{
$request->validate([
'title' => 'required|string|max:255',
'description' => 'nullable|string',
'completed' => 'nullable|boolean',
]);
$task = Task::create([
'title' => $request->input('title'),
'description' => $request->input('description'),
'completed' => $request->input('completed', false),
]);
return response()->json($task, 201);
}
public function update(Request $request, $id)
{
$task = Task::findOrFail($id);
$request->validate([
'title' => 'required|string|max:255',
'description' => 'nullable|string',
'completed' => 'nullable|boolean',
]);
$task->update([
'title' => $request->input('title'),
'description' => $request->input('description'),
'completed' => $request->input('completed', false),
]);
return response()->json($task);
}
public function destroy($id)
{
$task = Task::findOrFail($id);
$task->delete();
return response()->json(null, 204);
}