<!-- projecten partial -->
<div id="content-wrapper" class="projecten-content hidden animated fadeIn">
    <!-- projecten menu -->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 projecten-menu" onclick="openNav()"></div>

    <div class="project projecten-left" data-project="1">
        <img style="height: 100%; width: 100%;" src="{{ URL::asset('/images/projecten-test-image.jpg') }}" alt="test-image">
    </div>
    <div class="project projecten-middle" data-project="2">
        <img style="height: 100%; width: 100%;" style="height: 100%; width: 100%;"src="{{ URL::asset('/images/projecten-test-image.jpg') }}" alt="test-image">
    </div>
    <div class="project projecten-right" data-project="3">
        <img style="height: 100%; width: 100%;" src="{{ URL::asset('/images/projecten-test-image.jpg') }}" alt="test-image">
    </div>

    <!-- project navigation -->
    <div class="arrow-up next-projects" data-direction="previous-projects"></div>
    <div class="arrow-down previous-projects" data-direction="next-projects"></div>

    <div class="project-overlay invisible col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @include('partials.content.projecten.index')
    </div>
</div>
