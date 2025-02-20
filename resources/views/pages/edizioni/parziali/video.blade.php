<div class="card-group">
    @foreach($videos as $i => $video)
        <div class="flex">
            <div class="card m-2">
                <div class="card-body col" style="max-width:400px;">
                    {!! $video->getVideo($video->link) !!}
                    <span class="card-title bg-light p-2" style="font-size:12px;">{{ $video->getVideoTitle($video->link) }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
