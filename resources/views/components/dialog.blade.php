<div class="modal fade" id="{{ $id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        @if (isset($header))
          {{ $header }}
        @else
          <h5 class="modal-title">{{ $title }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        @endif

      </div>
      <div class="modal-body" id="dialogBody">
        {{ $body }}
      </div>
      @if (isset($footer))
      <div class="modal-footer">
        {{ $footer }}
      </div>
      @endif

    </div>
  </div>
</div>
