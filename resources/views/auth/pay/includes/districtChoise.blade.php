<option value="">--Choose your option--</option>
@foreach ($districts as $key => $value)
    <option value="{{$value->id_qh}}">
        {{$value->name_qh}}
    </option>
@endforeach
