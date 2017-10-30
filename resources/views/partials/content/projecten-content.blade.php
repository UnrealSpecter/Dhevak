<!-- projecten partial -->
<div id="content-wrapper" class="projecten-content hidden animated fadeIn">
    <!-- projecten menu -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 projecten-menu" onclick="openNav()"></div>

    <!-- projecten-image -->
    @foreach($projects as $index => $project)
        @if($index % 3 === 1)
        <div class="project projecten-left d-none" data-project="{{ $index }}">
            <img src="{{ $project->thumbnail_image_url }}" alt="{{ $project->title }}">
        </div>
        @elseif($index % 3 === 2)
        <div class="project projecten-middle d-none" data-project="{{ $index }}">
            <img src="{{ $project->thumbnail_image_url }}" alt="{{ $project->title }}">
        </div>
        @elseif($index % 3 === 0)
        <div class="project projecten-right d-none" data-project="{{ $index }}">
            <img src="{{ asset('') }}" alt="{{ $project->title }}">
        </div>
        @endif
    @endforeach

    <!-- project navigation -->
    <div class="arrow-up next-projects" data-direction="previous-projects"></div>
    <div class="arrow-down previous-projects" data-direction="next-projects"></div>

    <div class="project-overlay d-none col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('partials.content.projecten.index')
    </div>
</div>
