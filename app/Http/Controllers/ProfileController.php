<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Mise à jour du nom d'utilisateur
    $user->username = $request->input('username');

    // Mise à jour de la biographie
    $user->bio = $request->input('bio');

    // Mise à jour de l'email
    $user->fill($request->validated());

    // Si l'email a changé, réinitialisez la vérification de l'email
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showAvatarForm(Request $request): View
    {
        return view('profile.avatar', [
            'user' => $request->user(),
        ]);
    }

    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $user = $request->user();
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_path = $path;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }
    public function showProfile(User $user): View
    {
        $posts = $user->posts()->paginate(10);

        return view('profile.profile_utilisateur', compact('user', 'posts'));
    }

    public function follow(User $user)
{
    // Vérifier si l'utilisateur ne tente pas de se suivre lui-même
    if (auth()->user()->id === $user->id) {

        return redirect()->back()->with('error', 'Vous ne pouvez pas vous suivre vous-même.');
    }

    auth()->user()->following()->attach($user);
    return back();
}

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user);
        return back();
    }

}
