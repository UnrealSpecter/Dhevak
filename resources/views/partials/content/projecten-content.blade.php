<!-- projecten partial -->
<div class="content-wrapper projecten-content hidden animated fadeIn">
    <!-- projecten menu -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 projecten-menu" onclick="openNav()"></div>

    <!-- projecten-image -->
    @foreach($projects as $index => $project)
        @if(($index + 1) % 3 === 1)
        <div class="project projecten-left d-none" data-project-thumbnail="{{ $index + 1 }}">
            <img src="/uploads/thumbnails/{{ $project->thumbnail_image_url }}" alt="{{ $project->title }}">
        </div>
        @elseif(($index + 1) % 3 === 2)
        <div class="project projecten-middle d-none" data-project-thumbnail="{{ $index + 1 }}">
            <img src="/uploads/thumbnails/{{ $project->thumbnail_image_url }}" alt="{{ $project->title }}">
        </div>
        @elseif(($index + 1) % 3 === 0)
        <div class="project projecten-right d-none" data-project-thumbnail="{{ $index + 1 }}">
            <img src="/uploads/thumbnails/{{ $project->thumbnail_image_url }}" alt="{{ $project->title }}">
        </div>
        @endif
    @endforeach

    <!-- project navigation -->
    <div class="arrow-up cycle-projects" data-direction="next"></div>
    <div class="arrow-down cycle-projects" data-direction="previous"></div>

    <div class="project-overlay d-none col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('partials.content.projecten.index')
    </div>
</div>
