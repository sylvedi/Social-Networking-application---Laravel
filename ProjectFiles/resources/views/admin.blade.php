@extends('layouts.app')

@section('title', 'Admin Page')

@section('content')

<div class="container hero">.
	<p>{{ $message or 'no message' }}</p>
    <table>
    <tr><th>ID</th><th>Username</th><th>Suspend</th></tr>
    @forelse ($users as $user)
    
        <tr>
        
       <td><p>{{ $user->getId() }}</p></td>
       <td><p>{{ $user->getUsername() }}</p></td>
        @if (!$user->getSuspended())
        	<form method="post" action="{{ route('suspendUser') }}">
            	{{ csrf_field() }}
            	<td><input readonly hidden type="text" value="{{ $user->getId() }}" name="id"></input><button type="submit" value="Suspend">Suspend</button></td>
            </form>
        @else
        	<form method="post" action="{{ route('unsuspendUser') }}">
            	{{ csrf_field() }}
            	<td><input readonly hidden type="text" value="{{ $user->getId() }}" name="id"></input><button type="submit" value="Suspend">Restore</button></td>
            </form>
        @endif
        
        <form method="post" action="{{ route('deleteUser') }}">
        	{{ csrf_field() }}
        	<td><input readonly hidden type="text" value="{{ $user->getId() }}" name="id"></input><button type="submit" value="Delete">Delete</button></td>
        </form>
            
        </tr>
        
    @empty
        <p>No users</p>
    @endforelse
    
    </table>
</div>

@endsection