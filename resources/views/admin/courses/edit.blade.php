@extends('layouts.app')

@section('title', 'Edit Course &bull; ' . $course->title)

@section('content')
<div style="background-color: #f8fafc; min-height: 80vh; padding: 2.5rem 0;">
    <div class="container" style="max-width: 960px;">

        <div style="margin-bottom: 2rem;">
            <a href="{{ route('admin.courses.index') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none; margin-bottom: 0.4rem;">
                <i data-lucide="arrow-left" style="width: 1rem; height: 1rem;"></i>
                <span>Back to Courses</span>
            </a>
            <h1 style="font-size: 1.85rem; font-weight: 900; color: #0f172a; margin: 0;">Edit Course: {{ $course->title }}</h1>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.25rem;">Update course details and manage lesson images shown to students.</p>
        </div>

        @if (session('success'))
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem; color: #166534; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem;">
                <i data-lucide="check-circle" style="width: 1.1rem; height: 1.1rem;"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem; color: #991b1b; font-size: 0.85rem;">
                <strong style="display: block; margin-bottom: 0.25rem;">Please check the following errors:</strong>
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ===== COURSE DETAILS FORM ===== --}}
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 2rem;">
            <h2 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0 0 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid #f1f5f9;">Course Details</h2>
            <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data" class="custom-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title" class="form-label">Course Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}" required class="form-input">
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="price" class="form-label">Price (INR / ₹) *</label>
                        <input type="number" step="1" id="price" name="price" value="{{ old('price', $course->price) }}" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Publishing Status *</label>
                        <select id="status" name="status" class="form-select">
                            <option value="published" {{ old('status', $course->status) == 'published' ? 'selected' : '' }}>Published (Active)</option>
                            <option value="draft"     {{ old('status', $course->status) == 'draft'     ? 'selected' : '' }}>Draft (Hidden)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="level" class="form-label">Proficiency Level</label>
                        <input type="text" id="level" name="level" value="{{ old('level', $course->level) }}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="duration" class="form-label">Estimated Duration</label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration', $course->duration) }}" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Course Description *</label>
                    <textarea id="description" name="description" rows="5" required class="form-textarea">{{ old('description', $course->description) }}</textarea>
                </div>

                {{-- ===== UPLOAD NEW IMAGES ===== --}}
                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label" style="font-size: 1rem;">
                        <i data-lucide="image-plus" style="width: 1rem; height: 1rem; display: inline; vertical-align: middle; margin-right: 0.3rem;"></i>
                        Upload Lesson Images
                    </label>
                    <p style="font-size: 0.8rem; color: #64748b; margin: 0 0 0.75rem;">
                        Select one or multiple images. They will be added to the course and shown to students in the viewer. Accepts JPEG, PNG, WebP, GIF — any size.
                    </p>

                    <div id="upload-zone"
                         onclick="document.getElementById('images-input').click()"
                         ondragover="event.preventDefault(); this.classList.add('upload-zone-hover');"
                         ondragleave="this.classList.remove('upload-zone-hover');"
                         ondrop="handleDrop(event)"
                         style="border: 2px dashed #cbd5e1; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; background: #f8fafc; cursor: pointer; transition: border-color 0.2s, background 0.2s;">
                        <i data-lucide="upload-cloud" style="width: 3rem; height: 3rem; color: #94a3b8; display: block; margin: 0 auto 0.75rem;"></i>
                        <p style="font-size: 1rem; font-weight: 700; color: #334155; margin: 0 0 0.25rem;">Click or drag &amp; drop images here</p>
                        <p style="font-size: 0.8rem; color: #94a3b8; margin: 0;">Multiple images supported</p>
                    </div>

                    <input type="file" id="images-input" name="images[]" multiple accept="image/*"
                           style="position: absolute; width: 0; height: 0; opacity: 0; overflow: hidden;"
                           onchange="previewNewImages(this)">

                    {{-- New image previews appear here --}}
                    <div id="new-preview-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 0.85rem; margin-top: 1rem;"></div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                    <a href="{{ route('admin.courses.index') }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary" style="padding: 0.85rem 1.75rem;">
                        <i data-lucide="save" style="width: 1rem; height: 1rem;"></i>
                        <span>Save Course &amp; Upload Images</span>
                    </button>
                </div>

                <style>
                    #upload-zone:hover, #upload-zone.upload-zone-hover { border-color: #2563eb; background: #eff6ff; }
                </style>
                <script>
                    function previewNewImages(input) {
                        const grid = document.getElementById('new-preview-grid');
                        grid.innerHTML = '';
                        if (!input.files || input.files.length === 0) return;
                        Array.from(input.files).forEach((file, idx) => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const card = document.createElement('div');
                                card.style.cssText = 'border-radius:0.65rem;overflow:hidden;border:2px solid #e2e8f0;background:#f8fafc;position:relative;';
                                card.innerHTML = `
                                    <img src="${e.target.result}" style="width:100%;height:100px;object-fit:cover;display:block;">
                                    <p style="font-size:0.72rem;color:#475569;padding:0.4rem 0.5rem;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="${file.name}">${file.name}</p>
                                `;
                                grid.appendChild(card);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                    function handleDrop(event) {
                        event.preventDefault();
                        document.getElementById('upload-zone').classList.remove('upload-zone-hover');
                        const input = document.getElementById('images-input');
                        const dt = event.dataTransfer;
                        if (dt.files && dt.files.length > 0) {
                            input.files = dt.files;
                            previewNewImages(input);
                        }
                    }
                </script>
            </form>
        </div>

        {{-- ===== EXISTING IMAGES SECTION ===== --}}
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid #f1f5f9;">
                <h2 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0;">
                    <i data-lucide="images" style="width: 1.1rem; height: 1.1rem; display: inline; vertical-align: middle; margin-right: 0.35rem;"></i>
                    Uploaded Lesson Images
                    <span style="background: #e0f2fe; color: #0284c7; font-size: 0.75rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 9999px; margin-left: 0.5rem;">
                        {{ $course->images->count() }} images
                    </span>
                </h2>
                <span style="font-size: 0.8rem; color: #64748b;">Students see these in the course viewer</span>
            </div>

            @if($course->images->isEmpty())
                <div style="text-align: center; padding: 3rem 1rem; color: #94a3b8;">
                    <i data-lucide="image-off" style="width: 3rem; height: 3rem; display: block; margin: 0 auto 0.75rem;"></i>
                    <p style="font-size: 0.95rem; font-weight: 600; margin: 0;">No images uploaded yet.</p>
                    <p style="font-size: 0.8rem; margin: 0.25rem 0 0;">Upload images above and save the course.</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem;">
                    @foreach($course->images->sortBy('sort_order') as $index => $image)
                        @php
                            $imgUrl = asset('storage/' . $image->image_path);
                        @endphp
                        <div style="border-radius: 0.85rem; overflow: hidden; border: 2px solid #e2e8f0; background: #f8fafc; position: relative; transition: all 0.2s;" onmouseover="this.style.boxShadow='0 4px 14px rgba(0,0,0,0.12)'" onmouseout="this.style.boxShadow=''">
                            {{-- Image Preview with zoom indicator --}}
                            <div style="position: relative; cursor: pointer; overflow: hidden;" onclick="openImageModal('{{ $imgUrl }}', 'Image {{ $index + 1 }}')">
                                <img src="{{ $imgUrl }}"
                                     onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';"
                                     alt="Slide {{ $index + 1 }}"
                                     style="width: 100%; height: 120px; object-fit: cover; display: block; transition: transform 0.25s;"
                                     onmouseover="this.style.transform='scale(1.05)'"
                                     onmouseout="this.style.transform='scale(1)'">
                                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.25); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s;"
                                     onmouseover="this.style.opacity='1'"
                                     onmouseout="this.style.opacity='0'">
                                    <span style="background: rgba(0,0,0,0.7); color: #fff; font-size: 0.72rem; font-weight: 700; padding: 0.3rem 0.65rem; border-radius: 9999px; display: flex; align-items: center; gap: 0.3rem;">
                                        <i data-lucide="zoom-in" style="width: 0.85rem; height: 0.85rem;"></i> View
                                    </span>
                                </div>
                            </div>

                            <div style="padding: 0.6rem 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 0.75rem; font-weight: 700; color: #475569;">
                                    Image {{ $index + 1 }}
                                </span>
                                {{-- Delete Button --}}
                                <button type="button"
                                        onclick="deleteImage({{ $course->id }}, {{ $image->id }}, this)"
                                        style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; border-radius: 0.4rem; padding: 0.25rem 0.5rem; cursor: pointer; display: flex; align-items: center; gap: 0.25rem; font-size: 0.72rem; font-weight: 700; transition: background 0.15s;"
                                        onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'"
                                        title="Delete this image">
                                    <i data-lucide="trash-2" style="width: 0.75rem; height: 0.75rem;"></i>
                                    Delete
                                </button>
                            </div>
                        </div>

                        {{-- Hidden delete form --}}
                        <form id="del-form-{{ $image->id }}" method="POST"
                              action="{{ route('admin.courses.images.destroy', [$course->id, $image->id]) }}"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

{{-- Lightbox / Fullscreen Image Preview Modal --}}
<div id="image-lightbox-modal"
     style="display: none; position: fixed; inset: 0; z-index: 99999; background: rgba(15, 23, 42, 0.88); backdrop-filter: blur(6px); align-items: center; justify-content: center; padding: 1.5rem;"
     onclick="closeImageModal(event)">
    <div style="position: relative; max-width: 90vw; max-height: 90vh; display: flex; flex-direction: column; align-items: center;" onclick="event.stopPropagation()">
        {{-- Header bar with Title and Close --}}
        <div style="width: 100%; display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.75rem; color: #ffffff;">
            <div style="display: flex; align-items: center; gap: 0.6rem;">
                <span id="lightbox-title" style="font-weight: 700; font-size: 1rem; color: #f8fafc;"></span>
            </div>
            <button type="button"
                    onclick="closeImageModal()"
                    style="background: rgba(255,255,255,0.15); border: none; color: #ffffff; border-radius: 50%; width: 2.25rem; height: 2.25rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.15)'"
                    title="Close (Esc)">
                <i data-lucide="x" style="width: 1.25rem; height: 1.25rem;"></i>
            </button>
        </div>

        {{-- Main Large Image --}}
        <div style="position: relative; user-select: none;">
            <img id="lightbox-img"
                 src=""
                 onerror="this.onerror=null; this.src='{{ asset('images/placeholders/course-default.svg') }}';"
                 alt="Full preview"
                 draggable="false"
                 oncontextmenu="return false;"
                 style="max-width: 90vw; max-height: 82vh; object-fit: contain; border-radius: 0.75rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border: 1px solid rgba(255,255,255,0.15); background: #0f172a; pointer-events: none;">
        </div>
    </div>
</div>

<script>
    function openImageModal(imgSrc, title) {
        const modal = document.getElementById('image-lightbox-modal');
        const img = document.getElementById('lightbox-img');
        const titleEl = document.getElementById('lightbox-title');
        const downloadEl = document.getElementById('lightbox-download');

        img.src = imgSrc;
        titleEl.textContent = title || 'Image Preview';
        downloadEl.href = imgSrc;

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        if (window.lucide) {
            window.lucide.createIcons();
        }
    }

    function closeImageModal(e) {
        const modal = document.getElementById('image-lightbox-modal');
        modal.style.display = 'none';
        document.getElementById('lightbox-img').src = '';
        document.body.style.overflow = '';
    }

    // Keyboard support: Escape to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });

    function deleteImage(courseId, imageId, btn) {
        if (!confirm('Delete this image? Students will no longer see it.')) return;
        btn.disabled = true;
        btn.innerHTML = 'Deleting...';
        document.getElementById('del-form-' + imageId).submit();
    }
</script>
@endsection
