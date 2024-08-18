<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
  <li class="nav-item">
    <a href="{{ route('admin.dashboard')}}" class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('dashboard')}}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>

  {{-- <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['query'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['query'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Query
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.query.career') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['query.career'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Career
          </p>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{ route('admin.query.webinaq') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['query.webinaq'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Webinar
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.query.resourcq') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['query.resourcq'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Resource
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.query.contact') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['query.contact'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Contact
          </p>
        </a>
      </li>
      
    </ul>
  </li> --}}

  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive('banner')}}">
    <a href="{{ route('admin.banner.index')}}" class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('banner')}}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Banners
      </p>
    </a>
  </li>

  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive('ticker')}}">
    <a href="{{ route('admin.ticker.index')}}" class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('ticker')}}">
    <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Tickers
      </p>
    </a>
  </li>

  {{--Resource--}}

  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['resource'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['resource'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Resource
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.resource-category.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['resource-category.index', 'resource-category.create', 'resource-category.edit'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Resource Category 
          </p>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{ route('admin.resource.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['resource.index', 'resource.create', 'resource.edit'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Resource
          </p>
        </a>
      </li>
      
    </ul>
  </li>

  {{--service--}}

  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['service'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['service'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Service
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.service-category.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['service-category.index', 'service-category.create', 'service-category.edit'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Service Category 
          </p>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{ route('admin.service.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['service.index', 'service.create', 'service.edit'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Service
          </p>
        </a>
      </li>
      
    </ul>
  </li>

  {{--industry--}}

<li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['industry'])}}">
  <a href="#" 
  class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['industry'])}}">
    <i class="nav-icon fas fa-book"></i>
    <p>
    Industry
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    
    <li class="nav-item">
      <a href="{{ route('admin.industry-category.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['industry-category.index', 'industry-category.create', 'industry-category.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Industry Category 
        </p>
      </a>
    </li>
    
    <li class="nav-item">
      <a href="{{ route('admin.industry.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['industry.index', 'industry.create', 'industry.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Industry
        </p>
      </a>
    </li>
    
  </ul>
</li>

{{--Product--}}

<li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['product'])}}">
  <a href="#" 
  class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['product'])}}">
    <i class="nav-icon fas fa-book"></i>
    <p>
    Product
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    
    <li class="nav-item">
      <a href="{{ route('admin.product-category.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['product-category.index', 'product-category.create', 'product-category.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Product Category 
        </p>
      </a>
    </li>
    
    <li class="nav-item">
      <a href="{{ route('admin.product.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['product.index', 'product.create', 'product.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Product
        </p>
      </a>
    </li>
    
  </ul>
</li>

{{--Solution--}}

<li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['solution'])}}">
  <a href="#" 
  class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['solution'])}}">
    <i class="nav-icon fas fa-book"></i>
    <p>
    Solution
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    
    <li class="nav-item">
      <a href="{{ route('admin.solution-category.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['solution-category.index', 'solution-category.create', 'solution-category.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Solution Category 
        </p>
      </a>
    </li>
    
    <li class="nav-item">
      <a href="{{ route('admin.solution.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['solution.index', 'solution.create', 'solution.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Solution
        </p>
      </a>
    </li>
    
  </ul>
</li>



{{--marketplace--}}

<li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['marketplace'])}}">
  <a href="#" 
  class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['marketplace'])}}">
    <i class="nav-icon fas fa-book"></i>
    <p>
    Marketplace
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    
    <li class="nav-item">
      <a href="{{ route('admin.marketplace-category.index') }}" 
      class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['marketplace-category.index', 'marketplace-category.create', 'solution-category.edit'])}}">
        <i class="far fa-circle nav-icon"></i>
        <p>
        Marketplace Category 
        </p>
      </a>
    </li>
    
  </ul>
</li>

  {{--Webinar--}}

  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['webinar', 'speaker'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['webinar', 'speaker'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Webinar
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.webinar.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['webinar.index', 'webinar.create'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Create / List
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.speaker.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['speaker.index', 'speaker.create'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Speakers 
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.webinar.users') }}" 
        class="nav-link {{ (\Route::is('admin.webinar.users')) ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Registrations 
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.webinar_testimoni.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['webinar_testimoni'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Testimonials
          </p>
        </a>
      </li>

    </ul>
  </li>


  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive('navigation')}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('navigation')}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Navigation
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.navigation.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('navigation.index', 'navigation.edit')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Lists
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.navigation.create') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('navigation.create')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Add 
          </p>
        </a>
      </li>
    </ul>
  </li>

  {{--Blogs--}}
  <li class="nav-item
  {{\App\Helpers\AdminHelper::isNavActive('blog')}}
  ">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('blog')}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Blogs
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.blog-category.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('blog-category')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Blog Category
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.blogs.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['blogs','blogpost'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Blogs 
          </p>
        </a>
      </li>
    </ul>
  </li>

  {{--Careers--}}
  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['positions', 'life_merino', 'employee-speak'])}}">
    <a href="#" 
    class="nav-link 
    {{\App\Helpers\AdminHelper::isNavChildActive(['positions', 'life_merino', 'employee-speak'])}}
    ">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Careers
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.positions.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('admin.positions')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Position
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.life_merino.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('admin.life_merino')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Life@Merino 
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.employee-speak.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('admin.employee-speak.index')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Employees Speaks
          </p>
        </a>
      </li>

    </ul>
  </li>


  {{--Testimonials--}}
  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive('testimonials')}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('testimonials')}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Testimonials
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.testimonials.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('testimonials.index')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          List
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.testimonials.create') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive('testimonials.create')}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Create 
          </p>
        </a>
      </li>

    </ul>
  </li>

  {{--LOcations--}}
  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['locations', 'country'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['locations', 'country'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Locations
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      
      <li class="nav-item">
        <a href="{{ route('admin.country.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['country.index', 'country.create', 'country.edit'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Country List
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.locations.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['locations.index'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          List Locations
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.locations.create') }}" 
        class="nav-link {{ (\Route::is('admin.locations.create')) ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Create Location
          </p>
        </a>
      </li>

    </ul>
  </li>

  {{--News--}}
  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['news'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['news'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      News
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      

      <li class="nav-item">
        <a href="{{ route('admin.news.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['news.index'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          List
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.news.create') }}" 
        class="nav-link {{ (\Route::is('admin.news.create')) ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Create
          </p>
        </a>
      </li>

    </ul>
  </li>

  {{--Author--}}
  <li class="nav-item {{\App\Helpers\AdminHelper::isNavActive(['author'])}}">
    <a href="#" 
    class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['author'])}}">
      <i class="nav-icon fas fa-book"></i>
      <p>
      Author
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      

      <li class="nav-item">
        <a href="{{ route('admin.author.index') }}" 
        class="nav-link {{\App\Helpers\AdminHelper::isNavChildActive(['author.index'])}}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          List
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.author.create') }}" 
        class="nav-link {{ (\Route::is('admin.author.create')) ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>
          Create
          </p>
        </a>
      </li>

    </ul>
  </li>


  {{--end order form menu --}}
</ul>