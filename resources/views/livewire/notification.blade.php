{{-- <div>
    <h1>Laravel Livewire Notification Example - Codingspoint.com</h1>

    <button type="button" wire:click="alertSuccess" class="btn btn-success">Success Alert</button>
    <button type="button" wire:click="alertError" class="btn btn-danger">Error Alert</button>
    <button type="button" wire:click="alertInfo" class="btn btn-info">Info Alert</button>
</div> --}}

<div class="container">
    <h1>Toster</h1>
    <hr />
    <form wire:submit.prevent="tosterPost">
        <div class="form-group">
            <label for="name">Name</label>
            <input wire:model="name" type="text" class="form-control" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>
</div>
