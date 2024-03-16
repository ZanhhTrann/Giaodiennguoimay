<option value="">--Choose your option--</option>
@if(count($towns)>0)
    @foreach ($towns as $key => $value)
        <option value="{{$value->id_xp}}">
            {{$value->name_xp}}
        </option>
    @endforeach
@endif
