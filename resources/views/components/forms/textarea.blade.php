@props([
'labelText' => null,
'id',
'required' => false,
'defaulvalue' => null
])

<label for="{{$id}}" class="form-label">
    {{$labelText != null ? $labelText : ucfirst($id)  }}:
    <span class="text-danger">{{ $required ? '*' : '' }}</span>
</label>
<textarea {{$required ? 'required' : '' }}
    rows="3"
    name="{{$id}}"
    id="{{$id}}"
    class="form-control">{{old($id,$defaulvalue)}}</textarea>
@error('nombre')
<small class="text-danger">{{ '*'.$message }}</small>
@enderror