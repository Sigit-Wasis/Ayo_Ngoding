@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <!-- ... Header code ... -->
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Role</h1>
                @if ($errors->any())
                <!-- Display validation errors here -->
                @endif

                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Role edit form fields go here -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
