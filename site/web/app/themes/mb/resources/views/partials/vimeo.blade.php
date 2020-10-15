{{-- Vimeo Video with a Play Button --}}
<div class="vimeo video-trigger">
  {{-- Vimeo Video --}}
  @php($vimeo = get_sub_field('video'))
  @if($vimeo)
    <div class="vimeo-wrapper">
      <div id="vimeo-<?= $vimeo; ?>" class="vimeo-video"
        data-vimeo-width="100%" data-vimeo-responsive="1" data-vimeo-playsinline="true" data-vimeo-id="<?= $vimeo; ?>"></div>
    </div>
    <a href="#play" class="play-vimeo pin flex centered middle">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="31" viewBox="0 0 26 31">
        <g fill="none" fill-rule="evenodd"><g fill="#FFF"><g><g><path d="M13 3L28 28 -2 28z" transform="translate(-295 -1350) translate(40 1129) translate(255 221) rotate(90 13 15.5)"/></g></g></g></g>
      </svg>
    </a>
  @endif
  {{-- Image Placeholder --}}
  @php($image = get_sub_field('placeholder'))
  @if($image)
    <figure class="lazy-container">
      <img
        src="{{$image['url']}}"
        alt="{{$image['alt']}}" />
    </figure>
  @endif
</div>