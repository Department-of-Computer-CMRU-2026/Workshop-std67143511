<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::withCount('registrations')->orderBy('event_date')->get();
        return view('topics.index', compact('topics'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $topic->loadCount('registrations');
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'speaker_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'seat_limit' => 'required|integer|min:1',
            'event_date' => 'required|date',
        ]);

        Topic::create($validated);

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'speaker_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'seat_limit' => 'required|integer|min:1',
            'event_date' => 'required|date',
        ]);

        $topic->update($validated);

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }

    /**
     * Display the list of attendees for the specified resource.
     */
    public function attendees(Topic $topic)
    {
        $attendees = $topic->registrations()->orderBy('created_at', 'desc')->get();
        return view('topics.attendees', compact('topic', 'attendees'));
    }
}
