<!-- resources/views/posts/search.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Search Results</h1>

    <h2>Users</h2>
    @forelse ($users as $user)
        <p>{{ $user->username }}</p>
    @empty
        <p>No users found</p>
    @endforelse

    <h2>Posts</h2>
    @forelse ($posts as $post)
        <p>{{ $post->body }}</p>
    @empty
        <p>No posts found</p>
    @endforelse
@endsection
