@props([
    'labelText' => null,
    'id',
    'required' => false,
    'defaultValue' => null,
    'type' => 'text',
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">
        {{ $labelText ?? ucfirst($id) }}:
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input
        type="{{ $type }}"
        name="{{ $id }}"
        id="{{ $id }}"
        {{ $required ? 'required' : '' }}
        @if ($type === 'number') step="0.1" @endif
        value="{{ old($id, $defaultValue) }}"
        class="form-control @error($id) is-invalid @enderror">

    @error($id)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
