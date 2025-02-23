<?php

namespace App\Http\Controllers;

use App\Models\UserTheme;
use App\Http\Resources\UserThemeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Http\Requests\UserThemeRequest;

class UserThemeController extends Controller
{
    public function edit(Request $request)
    {
        $theme = $request->user()->theme ?? new UserTheme();
        Gate::authorize('view', $theme);

        return Inertia::render('UserTheme/Edit', [
            'theme' => new UserThemeResource($theme)
        ]);
    }

    public function update(UserThemeRequest $request)
    {
        $theme = $request->user()->theme ?? new UserTheme();
        Gate::authorize('update', $theme);

        $validated = $request->validated();

        $theme = $request->user()->theme()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return redirect()->route('user-theme.edit')
            ->with('theme', new UserThemeResource($theme))
            ->with('success', 'Theme updated successfully');
    }
}