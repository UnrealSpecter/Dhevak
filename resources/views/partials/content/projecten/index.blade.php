@foreach($projects as $index => $project)

<div class="project-content d-none" data-project="{{ $index + 1 }}">

    <div class="col-12 project-bg-title flex">{{ $project->title }}</div>

    <div class="col-12 scroll-down-indicator flex ">
        <img class="img-responsive scroll-down-button" src="{{ URL::asset('/images/arrow-down.jpg') }}">
    </div>

    <div class="col-12 flex project-title center">{{ $project->title }}</div>

    @if(count($project->roles) > 0)
    <div class=" col-12  sub-title subtitle-role center flex">onze rol</div>
    <div class="col-12 project-roles-wrapper flex ">
        @foreach($project->roles as $role)
            <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-2 project-role flex">
                <span class=" col-12 flex">{{ $role->name }}</span>
            </div>
        @endforeach
    </div>
    @endif

    <div class="col-12 sub-title flex center">Het Project</div>
    <!-- bootstrap text carousel carousel -->
    <div id="carousel-{{ $project->id }}-{{ $project->id }}" class="col-lg-8 offset-lg-2 carousel slide">
        <ol class="carousel-indicators">
            @foreach($project->descriptions as $index => $description)
                @if($loop->first)
                    <li data-target="#carousel-{{ $project->id }}-{{ $project->id }}" data-slide-to="{{ $index }}" class="active"></li>
                @else
                    <li data-target="#carousel-{{ $project->id }}-{{ $project->id }}" data-slide-to="{{ $index }}"></li>
                @endif
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox" style="height: 300px;">
            @foreach($project->descriptions as $description)
                @if($loop->first)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif
                        <p class="col-12 flex">{{ $description->content }}</p>
                    </div>
            @endforeach
        </div>
    </div>

    <!-- bootstrap image carousel carousel -->
    <div id="carousel{{ $project->id }}" class="col-lg-8 offset-lg-2 carousel slide" style="margin-top: 2.5%; margin-bottom: 2.5%;">
        <ol class="carousel-indicators">
            @if(count($project->images) > 1)
                @foreach($project->images as $index => $image)
                    @if($loop->first)
                        <li data-target="#carousel{{ $project->id }}" data-slide-to="{{ $index }}" class="active"></li>
                    @else
                        <li data-target="#carousel{{ $project->id }}" data-slide-to="{{ $index }}"></li>
                    @endif
                @endforeach
            @endif
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($project->images as $image)
                @if($loop->first)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif
                        <img class="d-block img-fluid" style="height: 500px; width: auto; margin: auto;" src="/uploads/images/{{ $image->image_url }}" alt="{{ $project->title }}">
                    </div>
            @endforeach
        </div>
        @if(count($project->images) > 1)
            <a class="carousel-control-prev" href="#carousel{{ $project->id }}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel{{ $project->id }}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    </div>

    <div class="col-12 sub-title center flex">het eindresultaat</div>
    <div class="col-12 flex project-website center">
        @if(! $loop->first)
            <div class="col-2 switch-project" data-project-index="{{ $index }}">vorige project</div>
        @else
            <div class="col-2"></div>
        @endif
        <a href="http://{{ $project->project_url }}" target="_blank">www.{{ $project->project_url }}</a>
        @if(!$loop->last)
            <div class="col-2 switch-project" data-project-index="{{ $index + 1 }}">volgende project</div>
        @else
            <div class="col-2"></div>
        @endif
    </div>

    @if(count($project->social_media) > 0)
    <div class="col-12 sub-title flex center">Social Media</div>
    <div class="col-12 project-social-media-wrapper flex">
        @foreach($project->social_media as $medium)
        <div class="col-4 col-sm-4 col-md-5 col-lg-2 project-social-media-link flex">
            <a class="flex" href="{{ $medium->pivot->social_media_url }}" target="_blank">
                <img class="img-fluid" src="{{ asset('/uploads/social-media/' . $medium->image_url) }}" alt="facebook-icon">
                <div class="social-media-text">{{ $medium->name }}</div>
            </a>
        </div>
        @endforeach
     </div>
     @endif

</div>

@endforeach
