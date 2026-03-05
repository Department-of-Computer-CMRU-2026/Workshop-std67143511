<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = \Illuminate\Support\Facades\Auth::user()->registrations()->with('topic')->get();
        return view('registrations.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Topic $topic)
    {
        // Prevent registration if full
        $registrationsCount = $topic->registrations()->count();
        if ($registrationsCount >= $topic->seat_limit) {
            return redirect()->route('welcome')->with('error', 'Sorry, this topic is already full.');
        }

        return view('registrations.create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Topic $topic)
    {
        // Prevent registration if full (double check)
        $registrationsCount = $topic->registrations()->count();
        if ($registrationsCount >= $topic->seat_limit) {
            return redirect()->route('welcome')->with('error', 'Sorry, this topic is already full.');
        }

        $validated = $request->validate([
            'student_id' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if (\Illuminate\Support\Facades\Auth::check()) {
            $user = \Illuminate\Support\Facades\Auth::user();

            // Check for duplicate registration
            if ($user->registrations()->where('topic_id', $topic->id)->exists()) {
                return redirect()->route('registrations.index')->with('error', 'You have already registered for this workshop.');
            }

            // Check if user has already registered for 3 workshops
            if ($user->registrations()->count() >= 3) {
                return redirect()->route('welcome')->with('error', 'You have reached the maximum limit of 3 workshop registrations.');
            }

            $validated['user_id'] = $user->id;
        }

        $validated['topic_id'] = $topic->id;

        if (\Illuminate\Support\Facades\Auth::check()) {
            $validated['user_id'] = \Illuminate\Support\Facades\Auth::id();
        }

        Registration::create($validated);

        return redirect()->route('registrations.index')->with('success', 'Registration successful! See you at the workshop.');
    }

    public function destroy(Registration $registration)
    {
        $topicId = $registration->topic_id;
        $registration->delete();

        return redirect()->route('topics.attendees', $topicId)->with('success', 'Attendee removed successfully.');
    }
}
