@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" novalidate>
@endif
@csrf
<div class="row cols-3">
    <div class="col">
        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                value="{{ old('project', $project->title) }}">
        </div>
    </div>

    <div class="col">
        {{-- Image URL --}}
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" placeholder="Image URL"
                value="{{ old('image', $project->image) }}">
        </div>
    </div>

    <div class="col">
        {{-- GitHub URL --}}
        <div class="mb-3">
            <label for="url" class="form-label">GitHub URL</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="GitHub URL"
                value="{{ old('url', $project->url) }}">
        </div>
    </div>
</div>


<div class="row row-cols-1">
    <div class="col">
        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{ old('description', $project->description) }}</textarea>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between">
    <div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
    <div class="mb-3">
        <button class="btn btn-small btn-success" type="submit">Submit</button>
    </div>
</div>
</form>
