@extends('layouts.frontend')

@section('content')
<div style="max-width: 650px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); font-family: 'Poppins', sans-serif;">
    <h2 style="margin-bottom: 8px; font-weight: 700; color: #1f2937;">Tambah Portofolio</h2>
    <p style="color: #6b7280; font-size: 14px; margin-bottom: 24px;">
        Menambahkan karya baru untuk: <strong style="color: #2563eb;">Jurusan {{ Auth::user()->name }}</strong>
    </p>

    @if ($errors->any())
        <div style="padding: 12px 16px; background-color: #fee2e2; color: #b91c1c; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Judul Karya / Proyek</label>
            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Aplikasi Sistem Kasir TEFA" required style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Nama Pembuat / Tim Siswa</label>
            <input type="text" name="pembuat" placeholder="Contoh: Tim Siswa RPL Angkatan 2025" value="{{ old('pembuat') }}" required style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none;">
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Deskripsi Singkat Karya</label>
            <textarea name="deskripsi" rows="4" placeholder="Jelaskan fitur utama atau keunggulan karya ini..." required style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none;">{{ old('deskripsi') }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px;">Upload Gambar Karya</label>
            <input type="file" name="gambar" accept="image/*" required style="width: 100%; font-size: 14px;">
            <small style="color: #6b7280; display: block; margin-top: 4px;">Format: PNG, JPG, JPEG, atau WEBP. Maksimal 2MB.</small>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <a href="{{ route('admin.portofolio.index') }}" style="padding: 10px 20px; border-radius: 8px; background: #e5e7eb; color: #374151; text-decoration: none; font-weight: 600; font-size: 14px;">Batal</a>
            <button type="submit" style="padding: 10px 24px; border-radius: 8px; background: #111827; color: #fff; border: none; font-weight: 600; font-size: 14px; cursor: pointer;">Simpan Portofolio</button>
        </div>
    </form>
</div>
@endsection