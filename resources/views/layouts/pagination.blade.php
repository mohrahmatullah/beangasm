<!-- Pagination -->
<div class="row">
  <div class="col-12 text-center">
    <nav aria-label="Page navigation">
      @if (isset($paginator) && $paginator->lastPage() > 1)
      <ul class="pagination d-inline-flex">
        <?php
          $interval = isset($interval) ? abs(intval($interval)) : 3 ;
          $from = $paginator->currentPage() - $interval;
          if($from < 1){
              $from = 1;
          }

          $to = $paginator->currentPage() + $interval;
          if($to > $paginator->lastPage()){
              $to = $paginator->lastPage();
          }
        ?>
        <!-- first/previous -->
        @if($paginator->currentPage() > 1)
          <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() - 1) }}">prev</a></li>
        @endif
        <!-- links -->
        @for($i = $from; $i <= $to; $i++)
            <?php 
            $isCurrentPage = $paginator->currentPage() == $i;
            ?>
            <li class="page-item"><a class="page-link {{ $isCurrentPage ? 'actived' : '' }}" href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">{{ $i }}</a></li>
        @endfor

        <!-- next/last -->
        @if($paginator->currentPage() < $paginator->lastPage()) 
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->currentPage() + 1) }}">next</a></li>
        @endif
      </ul>
      @endif
    </nav>
  </div>
</div>
<!-- /Pagination -->