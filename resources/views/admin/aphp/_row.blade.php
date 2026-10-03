{{-- Satu baris repeater. Variabel: $block, $rep, $i, $row --}}
<div class="mj-row" data-row>
  <div class="mj-row-head">
    <span class="mj-row-title"><i class="fas fa-grip-lines"></i> {{ $block['item'] }} <b data-num></b></span>
    <div class="mj-row-actions">
      <button type="button" class="mj-mini" data-move="up" title="Naikkan"><i class="fas fa-arrow-up"></i></button>
      <button type="button" class="mj-mini" data-move="down" title="Turunkan"><i class="fas fa-arrow-down"></i></button>
      <button type="button" class="mj-mini danger" data-remove title="Hapus baris ini"><i class="fas fa-trash"></i></button>
    </div>
  </div>
  <div class="mj-row-grid">
    @foreach($block['fields'] as $f)
      @php $val = is_array($row) && array_key_exists($f['key'], $row) ? $row[$f['key']] : $f['default']; @endphp
      <div class="{{ ($f['wide'] || $f['type'] === 'check') ? 'wide' : '' }}">
        @include('admin.aphp._field', [
          'f'        => $f,
          'name'     => "{$rep}[{$i}][{$f['key']}]",
          'fileName' => "{$rep}[{$i}][{$f['key']}_file]",
          'value'    => $val,
        ])
      </div>
    @endforeach
  </div>
</div>
