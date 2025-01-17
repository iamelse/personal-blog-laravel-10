<footer>
    <div class="container mt-4">
      <hr class="card-hr">
      <div class="row py-4">
        <div class="col-md-6">
          <p class="text-center text-lg-start text-md-start l-text-p l-card-text">Copyright © Iamelse. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-center text-lg-end text-md-end">
          <!-- Social Media Icons with Boxicons -->
          <ul class="list-inline">
          @forelse ($socialMedias as $socialMedia)
            <li class="list-inline-item">
              <a href="{{ $socialMedia->url }}" target="_blank" title="{{ $socialMedia->name }}">
                <i class='{!! strtolower($socialMedia->icon) !!} l-text-p bx-sm text l-text-primary'></i>
              </a>
            </li>
          @empty
              
          @endforelse
          </ul>
        </div>
      </div>
    </div>
</footer>