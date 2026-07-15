<option value="">Select country</option>

@foreach (config('countries.list') as $country)
    <option value="{{ $country }}" {{ $data == $country ? 'selected' : '' }}>{{ $country }}</option>
@endforeach
