{{-- Form satu section. Variabel: $major, $tab, $sections, $content --}}
@php $def = $sections[$tab]; @endphp

<form action="{{ route('admin.kuliner.section.update', $tab) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mj-intro">
    <div>
      <strong>{{ $def['label'] }}</strong>
      <span>{{ $def['desc'] }}</span>
    </div>
    <a href="{{ url('/keahlian/' . $major->slug) }}{{ $def['anchor'] ? '#' . $def['anchor'] : '' }}" target="_blank" class="mj-btn">
      <i class="fas fa-up-right-from-square"></i> Lihat di halaman publik
    </a>
  </div>

  @foreach($def['blocks'] as $b)
    <div class="db-panel" style="margin-bottom:1.2rem">
      <div class="db-panel-head">
        <h2 style="font-size:.9rem">{{ $b['title'] }}</h2>
        @if(isset($b['repeater']))
          <span style="font-size:.72rem;color:var(--text-muted)">Maksimal {{ $b['max'] }} · urutan di sini = urutan di halaman</span>
        @endif
      </div>

      @if(isset($b['repeater']))
        @php
          $rep  = $b['repeater'];
          $rows = old($rep, $content[$rep] ?? []);
        @endphp

        <div class="mj-rows" data-rows data-max="{{ $b['max'] }}" data-tpl="tpl-{{ $rep }}" data-next="1000">
          @foreach($rows as $i => $row)
            @include('admin.kuliner._row', ['block' => $b, 'rep' => $rep, 'i' => $i, 'row' => $row])
          @endforeach
        </div>

        <button type="button" class="mj-add" data-add><i class="fas fa-plus"></i> Tambah {{ $b['item'] }}</button>

        <template id="tpl-{{ $rep }}">
          @include('admin.kuliner._row', ['block' => $b, 'rep' => $rep, 'i' => '__i__', 'row' => []])
        </template>
      @else
        <div class="mj-grid-2">
          @foreach($b['fields'] as $f)
            <div class="{{ ($f['wide'] || $f['type'] === 'check') ? 'wide' : '' }}">
              @include('admin.kuliner._field', [
                'f'        => $f,
                'name'     => $f['key'],
                'fileName' => $f['key'] . '_file',
                'value'    => old($f['key'], $content[$f['key']] ?? $f['default']),
              ])
            </div>
          @endforeach
        </div>
      @endif
    </div>
  @endforeach

  <div class="mj-savebar">
    <span><i class="fas fa-circle-info" style="color:var(--gold)"></i> Perubahan berlaku setelah disimpan.</span>
    <button type="submit" class="db-btn db-btn-gold"><i class="fas fa-floppy-disk"></i> Simpan {{ $def['label'] }}</button>
  </div>
</form>
