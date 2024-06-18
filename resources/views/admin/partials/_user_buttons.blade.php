@if($user->deleted_at)
    <button type="button" class="btn btn-success"
            onclick="restoreUser(this, {{ $user->id }})" title="Restore"
            data-url="{{ route('users.restore', $user->id) }}"
            id="restoreBtn_{{ $user->id }}">
        <i class="fas fa-undo"></i>
    </button>
@else
    <a title="Hide" href="javascript:void(0);" class="btn btn-danger delete-permission"
       onclick="deleteUser(this, {{ $user->id }})"
       data-url="{{ route('users.delete', $user->id) }}">
        <i class="fas fa-ban"></i>
    </a>
@endif

