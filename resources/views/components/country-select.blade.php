
<select name="country" id="country" {{ $attributes->class(['form-control']) }}>
    @foreach($countries as $code => $name)

    <option value="{{ $code }}" @if($code == $selected) selected @endif>{{ $name }}</option>

    @endforeach

</select>
