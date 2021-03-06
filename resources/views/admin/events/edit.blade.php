@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Event</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.events.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.events.update',$event->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $event->name }}" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                  <strong>Location</strong><br>
                  <select class="js-example-basic-single" name=location_id>
                    @foreach($locations as $location)
                      <option value="{{ $location->id }}"
                      @if($event->location_id == $location->id)
                         selected
                      @endif
                      >{{ $location->name }}</option>
                    @endforeach
                  </select>
                  <a class="btn-sm btn-info" href={{ route('admin.locations.create')}}>New location</a>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $event->description }}</textarea>
                </div>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <strong>Date:</strong>
                    <input type="date" name="date" value="{{ $event->date }}" class="form-control" placeholder="Date">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Charity Raised:</strong>
                    <input type="text" name="charity_raised" value="{{ $event->charity_raised }}" class="form-control" placeholder="Charity Amount">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Forum Link:</strong>
                    <input type="text" name="forum_link" value="{{ $event->forum_link }}" class="form-control" placeholder="Forum Link">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Event Report:</strong>
                    <input type="text" name="report_link" value="{{ $event->report_link }}" class="form-control" placeholder="Report Link">
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
    <script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@endsection
