{{--
  Satu field. Variabel: $f (definisi), $name (nama input), $value, $fileName (khusus image/video)
--}}
@php
  $type = $f['type'];
@endphp

@if($type === 'check')
  <label class="mj-check">
    <input type="checkbox" name="{{ $name }}" value="1" @checked((bool) $value)>
    {{ $f['label'] }}
  </label>
  @if($f['hint'])<div class="mj-hint">{{ $f['hint'] }}</div>@endif
@else
  <div class="db-form-group" style="margin-bottom:0">
    <label>{{ $f['label'] }}@if($f['required']) <span style="color:#ff7875">*</span>@endif</label>

    @if($type === 'textarea')
      <textarea name="{{ $name }}" class="db-form-control" rows="3" maxlength="{{ $f['max'] }}">{{ $value }}</textarea>

    @elseif($type === 'icon')
      <div class="mj-icon-wrap">
        <span class="mj-icon-prev"><i class="fas {{ \App\Support\AphpContent::icon($value) }}"></i></span>
        <input type="text" name="{{ $name }}" class="db-form-control" data-icon maxlength="60"
               placeholder="fa-flask" value="{{ $value }}">
      </div>
      <div class="mj-hint">Nama ikon FontAwesome, diawali <code>fa-</code>. Cari di fontawesome.com/icons.</div>

    @elseif($type === 'tone')
      <select name="{{ $name }}" class="db-form-control">
        @foreach(\App\Support\AphpContent::TONES as $k => $label)
          <option value="{{ $k }}" @selected((string) $value === (string) $k)>{{ $label }}</option>
        @endforeach
      </select>

    @elseif($type === 'select')
      <select name="{{ $name }}" class="db-form-control">
        @foreach($f['options'] as $k => $label)
          <option value="{{ $k }}" @selected((string) $value === (string) $k)>{{ $label }}</option>
        @endforeach
      </select>

    @elseif($type === 'image' || $type === 'video')
      @php $url = \App\Support\AphpContent::url($value); @endphp
      <div class="mj-media">
        <div class="mj-media-prev" data-media-prev data-type="{{ $type }}">
          @if($url && $type === 'image')<img src="{{ $url }}" alt="">
          @elseif($url && $type === 'video')<video src="{{ $url }}" muted preload="metadata"></video>
          @else<i class="fas {{ $type === 'image' ? 'fa-image' : 'fa-film' }}"></i>@endif
        </div>
        <div class="mj-media-fields">
          <input type="file" name="{{ $fileName }}" class="db-form-control" data-file
                 accept="{{ $type === 'image' ? 'image/png,image/jpeg,image/webp,image/gif' : 'video/mp4,video/webm,video/ogg' }}">
          <input type="text" name="{{ $name }}" class="db-form-control" style="margin-top:.45rem" maxlength="255"
                 placeholder="atau path file di folder public, mis. images/aphp/foto.jpg" value="{{ $value }}">
          <div class="mj-hint">Upload file baru akan menggantikan path di bawah. Kosongkan path &amp; jangan upload = hapus.</div>
        </div>
      </div>

    @else
      <input type="text" name="{{ $name }}" class="db-form-control" maxlength="{{ $f['max'] }}" value="{{ $value }}">
    @endif

    @if($f['hint'] && !in_array($type, ['image', 'video'], true))<div class="mj-hint">{{ $f['hint'] }}</div>@endif
    @if(in_array($type, ['image', 'video'], true) && $f['hint'])<div class="mj-hint">{{ $f['hint'] }}</div>@endif
  </div>
@endif
