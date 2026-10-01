{{-- Pesan sukses & daftar error validasi. --}}
@if(session('status'))
  <div class="ad-flash ok"><i class="fas fa-circle-check"></i> <span>{{ session('status') }}</span></div>
@endif

@if($errors->any())
  <div class="ad-flash err">
    <strong><i class="fas fa-triangle-exclamation"></i> Data belum bisa disimpan, periksa hal berikut:</strong>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
