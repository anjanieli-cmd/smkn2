{{-- Mesin repeater bersama (tambah / hapus / naik / turun baris).
     Dipakai lewat: @push('scripts') @include('admin.partials.repeater-js') ... @endpush
     Menyediakan: window.adSetupRepeater({ listSelector, templateId, onFill }) --}}
<script>
  window.adSetupRepeater = function ({ listSelector, templateId, onFill }) {
    const list = document.querySelector(listSelector);
    const tpl  = document.getElementById(templateId);
    if (!list || !tpl) return null;

    function reindex() {
      list.querySelectorAll(':scope > [data-item]').forEach((item, i) => {
        item.querySelectorAll('[name]').forEach(el => {
          el.name = el.name.replace(/\[\d+\]|\[__I__\]/, `[${i}]`);
        });
        const label = item.querySelector('[data-label]');
        if (label) label.textContent = label.dataset.label + ' ' + (i + 1);
      });
    }

    function fillItem(node, data) {
      Object.keys(data).forEach(key => {
        const el = node.querySelector(`[name$="[${key}]"]`);
        if (!el) return;
        if (el.type === 'file') return;               // input file tidak boleh diisi lewat JS
        if (el.type === 'checkbox') el.checked = !!data[key];
        else el.value = data[key] ?? '';
      });
      if (typeof onFill === 'function') onFill(node, data);
    }

    function addItem(data) {
      const n = list.querySelectorAll(':scope > [data-item]').length;
      const html = tpl.innerHTML.replaceAll('__I__', String(n));
      const wrap = document.createElement('div');
      wrap.innerHTML = html.trim();
      const node = wrap.firstElementChild;
      list.appendChild(node);

      if (data) fillItem(node, data);

      node.querySelector('[data-remove]')?.addEventListener('click', () => { node.remove(); reindex(); });
      node.querySelector('[data-move="up"]')?.addEventListener('click', () => {
        const prev = node.previousElementSibling;
        if (prev) { list.insertBefore(node, prev); reindex(); }
      });
      node.querySelector('[data-move="down"]')?.addEventListener('click', () => {
        const next = node.nextElementSibling;
        if (next) { list.insertBefore(next, node); reindex(); }
      });

      reindex();
      return node;
    }

    return { addItem, reindex };
  };
</script>
