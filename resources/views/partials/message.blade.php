@if(Session::has('status'))
    <div class="card mb-4">
        <div class="card-body">
            <p class="alert {{Session::get('status')}}">
                {{Session::get('message')}}
            </p>
        </div>
    </div>
@endif
