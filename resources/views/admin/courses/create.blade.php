@extends('layouts.app')

@section('title', 'Create New Course &bull; Admin Panel')

@section('content')
<div style="background-color: #f8fafc; min-height: 80vh; padding: 2.5rem 0;">
    <div class="container" style="max-width: 800px;">

        <div style="margin-bottom: 2rem;">
            <a href="{{ route('admin.courses.index') }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #64748b; font-size: 0.85rem; font-weight: 600; text-decoration: none; margin-bottom: 0.4rem;">
                <i data-lucide="arrow-left" style="width: 1rem; height: 1rem;"></i>
                <span>Back to Courses</span>
            </a>
            <h1 style="font-size: 1.85rem; font-weight: 900; color: #0f172a; margin: 0;">Add New Course</h1>
            <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.25rem;">Create a course and upload learning slide images for students.</p>
        </div>

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

        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="custom-form">
                @csrf

                <!-- Title -->
                <div class="form-group">
                    <label for="title" class="form-label">Course Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-input" placeholder="e.g. Master English Grammar with Visuals">
                </div>

                <!-- Price, Status, Level -->
                <div class="form-row-2">
                    <div class="form-group">
                        <label for="price" class="form-label">Price (INR / ₹) *</label>
                        <input type="number" step="1" id="price" name="price" value="{{ old('price', '499') }}" required class="form-input" placeholder="499">
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Publishing Status *</label>
                        <select id="status" name="status" class="form-select">
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Active in Store)</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row-2">
                    <div class="form-group">
                        <label for="level" class="form-label">Proficiency Level</label>
                        <input type="text" id="level" name="level" value="{{ old('level', 'Beginner to Intermediate') }}" class="form-input" placeholder="e.g. Starter / All Levels">
                    </div>
                    <div class="form-group">
                        <label for="duration" class="form-label">Estimated Duration</label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration', '2 Months') }}" class="form-input" placeholder="e.g. 2 Months / Self-Paced">
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="form-label">Course Description &amp; Syllabus *</label>
                    <textarea id="description" name="description" rows="5" required class="form-textarea" placeholder="Explain what students will learn, who it is for, and key topics covered...">{{ old('description') }}</textarea>
                </div>

                <!-- Thumbnail Upload with Preview -->
                <div class="form-group">
                    <label class="form-label">Course Thumbnail Image</label>

                    <div id="thumb-upload-zone"
                         onclick="document.getElementById('thumbnail').click()"
                         ondragover="event.preventDefault(); this.classList.add('thumb-drag-over');"
                         ondragleave="this.classList.remove('thumb-drag-over');"
                         ondrop="handleThumbDrop(event)"
                         style="border: 2px dashed #cbd5e1; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; background: #f8fafc; cursor: pointer; transition: border-color 0.2s, background 0.2s;">

                        <div id="thumb-placeholder">
                            <div style="margin-bottom: 0.75rem;">
                                <i data-lucide="image-plus" style="width: 3rem; height: 3rem; color: #94a3b8;"></i>
                            </div>
                            <p style="font-size: 1rem; font-weight: 700; color: #334155; margin: 0 0 0.3rem;">Click or drag &amp; drop an image</p>
                            <p style="font-size: 0.8rem; color: #94a3b8; margin: 0;">Supports JPEG, PNG, WebP, GIF, SVG &mdash; any size</p>
                        </div>

                        <div id="thumb-preview-wrap" style="display: none;">
                            <img id="thumb-preview-new" src="" alt="Preview"
                                 style="max-width: 100%; max-height: 260px; border-radius: 0.75rem; object-fit: contain; border: 1px solid #e2e8f0; display: block; margin: 0 auto 1rem;">
                            <p id="thumb-preview-name" style="font-size: 0.8rem; color: #475569; font-weight: 600; margin: 0 0 0.3rem;"></p>
                            <p style="font-size: 0.75rem; color: #94a3b8; margin: 0;">Click or drag to replace</p>
                        </div>
                    </div>

                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                           style="position: absolute; width: 0; height: 0; opacity: 0; overflow: hidden;"
                           onchange="previewThumb(this)">
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                    <a href="{{ route('admin.courses.index') }}" class="btn-secondary">Cancel</a>
                    <button type="submit" class="btn-primary" style="padding: 0.85rem 1.75rem;">
                        <i data-lucide="check" style="width: 1rem; height: 1rem;"></i>
                        <span>Save &amp; Publish Course</span>
                    </button>
                </div>

                <style>
                    #thumb-upload-zone:hover, #thumb-upload-zone.thumb-drag-over {
                        border-color: #2563eb;
                        background: #eff6ff;
                    }
                </style>
                <script>
                    function previewThumb(input) {
                        if (!input.files || !input.files[0]) return;
                        const file = input.files[0];
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('thumb-placeholder').style.display = 'none';
                            const wrap = document.getElementById('thumb-preview-wrap');
                            wrap.style.display = 'block';
                            document.getElementById('thumb-preview-new').src = e.target.result;
                            document.getElementById('thumb-preview-name').textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                        };
                        reader.readAsDataURL(file);
                    }
                    function handleThumbDrop(event) {
                        event.preventDefault();
                        document.getElementById('thumb-upload-zone').classList.remove('thumb-drag-over');
                        const dt = event.dataTransfer;
                        if (dt.files && dt.files[0]) {
                            const input = document.getElementById('thumbnail');
                            input.files = dt.files;
                            previewThumb(input);
                        }
                    }
                </script>
            </form>
        </div>

    </div>
</div>
@endsection
