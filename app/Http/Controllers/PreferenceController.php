<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function setLocale(Request $request, string $locale)
    {
        if (! in_array($locale, ['en', 'ar'])) {
            abort(404);
        }

        if ($request->user()) {
            $request->user()->update(['locale' => $locale]);
        } else {
            $request->session()->put('locale', $locale);
        }

        return back();
    }

    public function setTheme(Request $request, string $theme)
    {
        if (! in_array($theme, ['light', 'dark'])) {
            abort(404);
        }

        if ($request->user()) {
            $request->user()->update(['theme' => $theme]);
        } else {
            $request->session()->put('theme', $theme);
        }

        return back();
    }
}
