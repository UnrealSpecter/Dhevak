<!-- projecten partial -->
<div id="content-wrapper" class="projecten-content hidden animated fadeIn">
    <!-- projecten menu -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 projecten-menu" onclick="openNav()"></div>

    <!-- projecten-image -->
    <div class="project projecten-left" data-project="1">
        <img src="{{ URL::asset('/images/projecten-test-image.jpg') }}" alt="{{ project->title }}">
    </div>
    <div class="project projecten-middle" data-project="2">
        <img src="{{ URL::asset('/images/projecten-test-image.jpg') }}" alt="{{ project->title }}">
    </div>
    <div class="project projecten-right" data-project="3">
        <img src="{{ URL::asset('/images/projecten-test-image.jpg') }}" alt="{{ project->title }}">
    </div>

    <!-- project navigation -->
    <div class="arrow-up next-projects" data-direction="previous-projects"></div>
    <div class="arrow-down previous-projects" data-direction="next-projects"></div>

    <div class="project-overlay d-none col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('partials.content.projecten.index')
    </div>
</div>
