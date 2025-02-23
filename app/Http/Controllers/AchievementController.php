<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Http\Requests\AchievementRequest;
use App\Http\Resources\AchievementResource;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class AchievementController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Achievement::class);
        $achievements = Achievement::all();
        return Inertia::render('Achievements/Index', [
            'achievements' => $achievements
        ]);
    }

    public function show(Achievement $achievement)
    {
        Gate::authorize('view', $achievement);
        return Inertia::render('Achievements/Show', [
            'achievement' => $achievement->load('users')
        ]);
    }

    public function store(AchievementRequest $request)
    {
        Gate::authorize('create', Achievement::class);
        $achievement = Achievement::create($request->validated());

        return redirect()->route('achievements.show', 
            new AchievementResource($achievement)
        );
    }

    public function update(AchievementRequest $request, Achievement $achievement)
    {
        Gate::authorize('update', $achievement);
        $achievement->update($request->validated());

        return redirect()->route('achievements.show', 
            new AchievementResource($achievement)
        );
    }

    public function destroy(Achievement $achievement)
    {
        Gate::authorize('delete', $achievement);
        $achievement->delete();
        return redirect()->route('achievements.index');
    }
} 