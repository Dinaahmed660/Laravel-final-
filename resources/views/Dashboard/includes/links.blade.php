            <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li><a href="{{route('index')}}" class="nav-item nav-link {{ request()->is('index') ? 'active' : '' }}">Home</a></li>
                  <li><a href="{{route('listing')}}" class="nav-item nav-link {{ request()->is('Listing') ? 'active' : '' }}">Listing</a></li>
                  <li><a href="{{route('Dashtestimonials')}}" class="nav-item nav-link {{ request()->is('Dashtestimonials') ? 'active' : '' }}">Testimonials</a></li>
                  <li><a href="{{route('blog')}}" class="nav-item nav-link {{ request()->is('blog') ? 'active' : '' }}">Blog</a></li>
                  <li><a href="{{route('about')}}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a></li>
                  <li><a href="{{route('Dashboard/Contact')}}" class="nav-item nav-link {{ request()->is('Dashboard/Contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
              </nav>