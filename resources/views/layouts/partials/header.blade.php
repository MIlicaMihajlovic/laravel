<header class="blog-header py-3">
  <div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 d-flex justify-content-end align-items-center">
      
      

      <!-- proverava da li je korisnik ulogovan -->
      @if(auth()->check()) 
          Hello, {{ auth()->user()->name }}
          <a href="/logout">Logout</a>     
      @else
          <a href="/login">Login</a>
          <a class="btn btn-sm btn-outline-secondary" href="/register">Sign up</a>
      @endif
<!-- u zavisnosti da li je ulogovan pokazivace log in ili log out -->

    </div>
  </div>
</header>