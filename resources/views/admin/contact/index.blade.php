@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Contacts</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Contact</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ @$contact->phone }}">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="mail" class="form-control" value="{{ @$contact->mail }}">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ @$contact->address }}">
                    </div>

                    <div class="form-group">
                        <label>Google Map Link</label>
                        <input type="text" name="map_link" class="form-control" value="{{ @$contact->map_link }}">
                    </div>

                    <button type="submit" class="btn btn-primary"> Update </button>

                </form>
            </div>
        </div>

    </section>
@endsection
