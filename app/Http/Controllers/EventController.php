<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $page_title = 'Event';
        $resource = 'event';

        $query = event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');

        $data = $query->paginate(8)->withQueryString();

        return view('project.index', compact('page_title', 'resource', 'data'));
    }
    
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();
    
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
    
            $extension = $file->getClientOriginalExtension();
            $userId = Auth::id();
            $timestamp = now()->format('YmdHis');
    
            $filename = "project{$userId}_{$timestamp}.{$extension}";
            $destination = public_path('projects');
    
            $file->move($destination, $filename);
    
            $validated['file_name'] = $filename;
            $validated['file_path'] = "projects/{$filename}"; 
        }
    
        $validated['user_id'] = Auth::id();
    
        Event::create($validated);
    
        return redirect()
            ->route('event.index')
            ->with('success', 'Event successfully created!');
    }
    
    public function show(Event $event)
    {
        $resource = 'event';
        return view('project.show', compact('event', 'resource'));
    }
    
    public function update(ProjectRequest $request, Event $event)
    {
        $validated = $request->validated();
    
        if ($request->hasFile('file_name')) {
            if ($event->file_path && File::exists(public_path($event->file_path))) {
                File::delete(public_path($event->file_path));
            }
    
            $file = $request->file('file_name');
            $extension = $file->getClientOriginalExtension();
            $userId = Auth::id();
            $timestamp = now()->format('YmdHis');
    
            $filename = "event{$userId}_{$timestamp}.{$extension}";
            $destination = public_path('events');
    
            $file->move($destination, $filename);
    
            $validated['file_name'] = $filename;
            $validated['file_path'] = "events/{$filename}";
        } else {
            $validated['file_name'] = $event->file_name;
            $validated['file_path'] = $event->file_path;
        }
    
        $validated['user_id'] = Auth::id();
    
        $event->update($validated);
    
        return redirect()
            ->route('event.index')
            ->with('success', 'Event successfully updated!');
    }
    
    public function destroy(Event $event)
    {
        if ($event->file_path && File::exists(public_path($event->file_path))) {
            File::delete(public_path($event->file_path));
        }
    
        $event->delete();
    
        return redirect()
            ->route('event.index')
            ->with('success', 'Event successfully deleted!');
    }
}
