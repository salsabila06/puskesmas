 <div class="main-sidebar">
     <aside id="sidebar-wrapper">
         <div class="sidebar-brand">
             <a href="/" class="text-success">CLUSTERING</a>
         </div>
         <div class="sidebar-brand sidebar-brand-sm">
             <a href="/">CT</a>
         </div>
         <ul class="sidebar-menu">

             @foreach ($sidebar as $item)
                 <li class="{{ request()->segment(1) == str_replace('/', '', $item->menu->menu_url) ? 'active' : '' }} ">
                     <a class="nav-link" href="{{ $item->menu->menu_url }}">
                         <iconify-icon icon="{{ $item->menu->menu_icon }}"
                             style="width: 28px; margin-right: 20px; text-align: center;"></iconify-icon>
                         <span>{{ $item->menu->menu_name }}</span>
                     </a>
                 </li>
             @endforeach

         </ul>
     </aside>
 </div>
