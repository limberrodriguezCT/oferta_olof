@props(['name', 'label', 'type' => 'text', 'options' => [], 'required' => false])
<div class="{{ $type === 'textarea' ? 'md:col-span-2' : '' }}">
    <label for="{{ $name }}" class="block text-sm font-bold text-[#003876] mb-2">{{ $label }} @if($required)<span class="text-[#E91E63]" aria-hidden="true">*</span>@endif</label>
    @if($type === 'select')
        <select id="{{ $name }}" name="{{ $name }}" @required($required) aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" @if($errors->has($name)) aria-describedby="{{ $name }}-error" @endif class="w-full rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:border-[#0089D0] focus:ring-[#0089D0] transition">
            <option value="">Seleccione una opción</option>
            @foreach($options as $value => $text)
                <option value="{{ $value }}" @selected((string) old($name) === (string) $value)>{{ $text }}</option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" rows="3" maxlength="2000" @required($required) aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" @if($errors->has($name)) aria-describedby="{{ $name }}-error" @endif class="w-full rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:border-[#0089D0] focus:ring-[#0089D0] transition">{{ old($name) }}</textarea>
    @else
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name) }}" @required($required) @if($type === 'number') min="{{ $name === 'anio_egreso_bachillerato' ? 1900 : 1 }}" max="{{ $name === 'anio_egreso_bachillerato' ? 2027 : 1000 }}" @elseif($type === 'date') max="{{ now('America/Managua')->subDay()->toDateString() }}" @else maxlength="{{ $type === 'tel' ? 30 : 255 }}" @endif aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}" @if($errors->has($name)) aria-describedby="{{ $name }}-error" @endif class="w-full rounded-xl border-gray-300 bg-gray-50 focus:bg-white focus:border-[#0089D0] focus:ring-[#0089D0] transition">
    @endif
    @error($name)<p id="{{ $name }}-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
</div>
