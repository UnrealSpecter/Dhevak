@foreach($projects as $project)

<div class="project-content d-none" data-project="{{ $project->id }}">

    <div class="col-12 project-bg-title center">{{ $project->title }}</div>

    <div class="scroll-down-indicator flex col-12">
        <img class="img-responsive scroll-down-button" src="{{ URL::asset('/images/arrow-down.jpg') }}">
    </div>

    <div class="col-12 project-title center">{{ $project->title }}</div>

    <div class="sub-title subtitle-role col-12 center">onze rol</div>
    <div class="project-roles-wrapper col-12">
        @foreach($project->roles as $role)
            <div class="col-4 project-role flex">{{ $role->name }}</div>
        @endforeach
    </div>

    <!-- <div class="sub-title col-lg-12 center">Het Project</div> -->
    <!-- custom text carousel -->
    <!-- <section class="projects">
        <div>
            <ul id="projects-ul">
                @foreach($project->descriptions as $description)
                <li>
                    <p class="col-lg-8 offset-lg-2"> {{ $description->content }}</p>
                    <small>Some dude</small>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="projects-control">
            <i class="fa fa-angle-left fa-2x" id="projects-l"></i>
            <i class="fa fa-angle-right fa-2x" id="projects-r"></i>
        </div>
    </section> -->

    <!-- bootstrap image carousel carousel -->
    <!-- <div id="carousel{{ $project->id }}" class="carousel slide col-lg-8 offset-lg-2">
        <div class="carousel-inner" role="listbox">
            @foreach($project->images as $image)
                @if($loop->first)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif
                        <img class="d-block img-responsive" style="height: 100%; width: 100%;" src="/uploads/images/{{ $image->image_url }}" alt="{{ $project->title }}">
                    </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel{{ $project->id }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel{{ $project->id }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> -->

    <!-- <div class="sub-title col-lg-12 center">het eindresultaat</div>
    <div class="col-lg-12 flex project-website center">
        <a href="" target="_blank">{{ $project->project_url }}</a>
    </div> -->

    <!-- <div class="sub-title col-lg-12 center">Social Media</div> -->
    <!-- <div class="col-lg-12 project-social-media-wrapper"> -->
        @foreach($project->social_media as $medium)
        <!-- <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 project-social-media-link flex">
            <a class="flex" href="{{ $medium->pivot->social_media_url }}" target="_blank">
                <img class="img-fluid" src="{{ asset('/uploads/social-media/' . $medium->image_url) }}" alt="facebook-icon">
                <div class="social-media-text">{{ $medium->name }}</div>
            </a>
        </div> -->
        @endforeach
    <!-- </div> -->
</div>

@endforeach
