@foreach($data as $key=>$items)
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="accordion" id="accordion1">
            <div class="card">
                <div class="card-header" id="headingOne{{ $items->id }}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne{{ $items->id }}">{{ $items->sub_heading }}</button>
                    </h2>
                </div>
                <div id="collapseOne{{ $items->id }}" class="collapse show" aria-labelledby="headingOne{{ $items->id }}" data-parent="#accordion1">
                    <div class="card-body">
                        {{ $items->detail }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach 