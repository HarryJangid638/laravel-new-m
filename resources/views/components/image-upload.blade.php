{{-- Single (create) 
<x-image-upload
    mode="single"
    name="avatar"
    label="Profile Picture"
    accept="image/*"
    placeholder="https://via.placeholder.com/200x200?text=Avatar"
/>

--}}

{{-- Multiple (create) 
<x-image-upload
    mode="multiple"
    name="gallery[]"
    label="Product Gallery"
    accept="image/*"
/>

--}}

{{-- Single (edit)
<x-image-upload
    mode="single"
    name="avatar"
    label="Profile Picture"
    :value="$user->avatar_url"          
    :existingId="$user->avatar_id"      
    accept="image/*"
/>

--}}

{{-- Multiple (edit) — preferred: with IDs 
<x-image-upload
    mode="multiple"
    name="gallery[]"
    label="Product Gallery"
    :existing="$product->images->map(fn($img) => ['id' => $img->id, 'url' => $img->url])->toArray()"
/>
--}}
{{-- Multiple (edit) — fallback: only URLs 
<x-image-upload
    mode="multiple"
    name="gallery[]"
    label="Screenshots"
    :values="$post->screenshots->pluck('url')->toArray()"
/>
--}}
@props([
    'id' => uniqid('upload_'),
    'mode' => $mode ?? 'single',                         // 'single' | 'multiple'
    'name' => $name ?? ($mode === 'multiple' ? 'files[]' : 'file'),
    'label' => $label ?? ($mode === 'multiple' ? 'Upload Images' : 'Upload Image'),
    'value' => $value ?? null,                            // single existing URL
    'accept' => $accept ?? 'image/*',                      // e.g. 'image/*', 'application/pdf'
    'values' => $values ?? null,                           // array of existing URLs (multiple)
    'existing' => $existing ?? null,                         // array of ['id' => X, 'url' => Y] for multiple (preferred)
    'existingId' => $existingId ?? null,                       // single existing file id (optional)
    'placeholder' => $placeholder ?? 'https://placehold.co/600x400?text=Dummy+Image',
])

@if($mode === 'single')
    <div class="image-preview" x-data="singleUpload('{{ $id }}', '{{ $placeholder }}')">
        <label for="{{ $id }}" class="upload-label">{{ $label }}</label>

        <input type="file" id="{{ $id }}" name="{{ $name }}" accept="{{ $accept }}" hidden x-ref="fileInput">

        {{-- Existing (edit) support --}}
        @if($value)
            <img x-ref="preview" src="{{ $value }}" alt="preview">
            <input type="hidden" name="existing_value" value="{{ $value }}">
            @if($existingId)
                <input type="hidden" name="existing_id" value="{{ $existingId }}">
            @endif
            <input type="hidden" name="remove_existing" value="0" x-ref="removeExistingFlag">
            <button class="btn-icon" type="button" @click="$refs.fileInput.click()" aria-label="Add">+</button>
            <button class="btn-delete" type="button" @click="remove(true)" style="display:block" aria-label="Delete">✕</button>
        @else
            <img x-ref="preview" src="{{ $placeholder }}" alt="preview">
            <input type="hidden" name="remove_existing" value="0" x-ref="removeExistingFlag">
            <button class="btn-icon" type="button" @click="$refs.fileInput.click()" aria-label="Add">+</button>
            <button class="btn-delete" type="button" @click="remove(true)" style="display:none" aria-label="Delete">✕</button>
        @endif
    </div>
@else
    <div x-data="multiUpload('{{ $id }}')" class="multi-wrapper">
        <label for="{{ $id }}" class="upload-label">{{ $label }}</label>

        <div class="multi-preview" x-ref="container">
            {{-- Existing (edit) support — prefer structured `existing=[['id'=>..,'url'=>..], ...]` --}}
            @if(is_array($existing) && count($existing))
                @foreach($existing as $item)
                    <div class="item" data-existing-id="{{ $item['id'] }}" data-existing-url="{{ $item['url'] }}">
                        <img src="{{ $item['url'] }}" alt="image">
                        <button type="button" class="btn-del" @click="removeExisting($event)" aria-label="Delete">✕</button>
                        <input type="hidden" name="existing_ids[]" value="{{ $item['id'] }}">
                    </div>
                @endforeach
            @elseif(is_array($values) && count($values))
                {{-- Fallback: only URLs provided --}}
                @foreach($values as $url)
                    <div class="item" data-existing-url="{{ $url }}">
                        <img src="{{ $url }}" alt="image">
                        <button type="button" class="btn-del" @click="removeExisting($event)" aria-label="Delete">✕</button>
                        <input type="hidden" name="existing_urls[]" value="{{ $url }}">
                    </div>
                @endforeach
            @endif

            {{-- Add box --}}
            <div class="multi-add" @click="$refs.fileInput.click()" aria-label="Add">+</div>
        </div>

        <input type="file" id="{{ $id }}" name="{{ $name }}" accept="{{ $accept }}" multiple hidden x-ref="fileInput">
        {{-- These will be appended on delete so the controller knows what to remove --}}
        <div x-ref="hiddenBin" style="display:none;"></div>
        <p class="note">Tip: select multiple files at once. Selecting again may replace the previous selection (browser limitation).</p>
    </div>
@endif
@once
    @push('styles')
        <style>
            .upload-label{display:block;font-weight:600;margin-bottom:6px;color:#444}
            .image-preview{position:relative;display:inline-block;max-width:200px}
            .image-preview img{width:100%;height:auto;border-radius:8px;border:1px solid #ddd;object-fit:cover}
            .btn-icon{
                position:absolute;bottom:6px;right:6px;background:#0d6efd;color:#fff;border:none;border-radius:50%;
                width:32px;height:32px;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center
            }
            .btn-delete{
                position:absolute;top:6px;right:6px;background:rgba(220,53,69,0.9);color:#fff;border:none;border-radius:50%;
                width:28px;height:28px;cursor:pointer;display:none
            }
            .multi-wrapper{max-width:100%}
            .multi-preview{display:flex;flex-wrap:wrap;gap:10px}
            .multi-preview .item{position:relative;width:120px;height:120px}
            .multi-preview img{width:100%;height:100%;border-radius:8px;border:1px solid #ddd;object-fit:cover}
            .multi-preview .btn-del{
                position:absolute;top:4px;right:4px;background:rgba(220,53,69,0.9);color:#fff;border:none;border-radius:50%;
                width:24px;height:24px;cursor:pointer
            }
            .multi-add{
                width:120px;height:120px;border:2px dashed #bbb;border-radius:8px;display:flex;align-items:center;
                justify-content:center;cursor:pointer;font-size:28px;color:#666
            }
            .note{font-size:12px;color:#777;margin-top:6px}
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/alpinejs" defer></script>
        <script>
        document.addEventListener('alpine:init', () => 
        {
            // SINGLE
            Alpine.data('singleUpload', (id, placeholder) => ({
                init() {
                    this.input = document.getElementById(id);
                    this.preview = this.$refs.preview;
                    this.deleteBtn = this.$root.querySelector('.btn-delete');
                    this.removeFlag = this.$refs.removeExistingFlag;

                    this.input.addEventListener('change', () => 
                    {
                        const file = this.input.files[0];
                        if (file) 
                        {
                            this.preview.src = URL.createObjectURL(file);
                            this.deleteBtn.style.display = 'block';
                            if (this.removeFlag) this.removeFlag.value = '0';
                        }
                    });
                },
                remove(markExisting = false) 
                {
                    // Clear newly selected file
                    if (this.input) this.input.value = '';
                    // Reset preview
                    if (this.preview) this.preview.src = placeholder;
                    // Hide delete
                    if (this.deleteBtn) this.deleteBtn.style.display = 'none';
                    // If we had an existing image, mark for removal
                    if (markExisting && this.removeFlag) 
                    {
                        this.removeFlag.value = '1';
                    }
                }
            }));

            // MULTIPLE
            Alpine.data('multiUpload', (id) => ({
                init() {
                    this.input = document.getElementById(id);
                    this.container = this.$refs.container;
                    this.hiddenBin = this.$refs.hiddenBin;

                    this.input.addEventListener('change', () => 
                    {
                        // NOTE: Browsers replace FileList on every pick; for true accumulation use a library like FilePond.
                        Array.from(this.input.files).forEach((file) => 
                        {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                const wrap = document.createElement('div');
                                wrap.classList.add('item');
                                wrap.innerHTML = `
                                    <img src="${e.target.result}" alt="image">
                                    <button type="button" class="btn-del" aria-label="Delete">✕</button>
                                `;
                                this.container.insertBefore(wrap, this.container.querySelector('.multi-add'));
                                wrap.querySelector('.btn-del').addEventListener('click', () => {
                                    // Deleting a new (not yet uploaded) file only removes the preview.
                                    wrap.remove();
                                    // We cannot surgically remove a single file from FileList for security reasons.
                                    // If user re-opens picker, they should re-select. For advanced needs, use FilePond/Dropzone.
                                });
                            };
                            reader.readAsDataURL(file);
                        });
                    });
                },
                removeExisting(event) 
                {
                    const wrap = event.target.closest('.item');
                    if (!wrap) return;

                    const existingId  = wrap.dataset.existingId;
                    const existingUrl = wrap.dataset.existingUrl;

                    // Append hidden inputs so backend knows what to remove
                    if (existingId) 
                    {
                        const input = document.createElement('input');
                        input.type  = 'hidden';
                        input.name  = 'remove_existing_ids[]';
                        input.value = existingId;
                        this.hiddenBin.appendChild(input);
                    } 
                    else if (existingUrl) 
                    {
                        const input = document.createElement('input');
                        input.type  = 'hidden';
                        input.name  = 'remove_existing_urls[]';
                        input.value = existingUrl;
                        this.hiddenBin.appendChild(input);
                    }

                    // Remove visible preview AND the original hidden "existing_*" input
                    const prevHidden = wrap.querySelector('input[type="hidden"]');
                    if (prevHidden) prevHidden.remove();
                    wrap.remove();
                }
            }));
        });
        </script>
    @endpush
@endonce
