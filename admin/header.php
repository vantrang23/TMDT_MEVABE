 <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
   <div class="sidebar-brand d-none d-md-flex">
     <!-- <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg> -->
     <!-- <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg> -->
   </div>
   <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
     <li class="nav-item"><a class="nav-link" href="index.php">
         <svg class="nav-icon">
           <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home"></use>
         </svg> HOME<span class="badge badge-sm bg-info ms-auto"></span></a></li>
     <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
         <svg class="nav-icon">

           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-female"></use> -->

         </svg> NGƯỜI DÙNG</a>

       <ul class="nav-group-items">
         <li class="nav-item"><a class="nav-link" href="user/add.php"><span class="nav-icon"></span> Thêm người dùng</a></li>
         <li class="nav-item"><a class="nav-link" href="user/list.php"><span class="nav-icon"></span> Danh sách người dùng</a></li>
       </ul>
     </li>
     <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
         <svg class="nav-icon">
           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-group"></use> -->
         </svg> DANH MỤC</a>
       <ul class="nav-group-items">
         <li class="nav-item"><a class="nav-link" href="category/add.php"><span class="nav-icon"></span> Thêm danh mục</a></li>
         <li class="nav-item"><a class="nav-link" href="category/list.php"><span class="nav-icon"></span> Danh sách danh mục</a></li>
       </ul>
     </li>
     <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
         <svg class="nav-icon">
           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use> -->
         </svg> SẢN PHẨM</a>
       <ul class="nav-group-items">
         <li class="nav-item"><a class="nav-link" href="product/add.php"> Thêm sản phẩm</a></li>
         <li class="nav-item"><a class="nav-link" href="product/list.php"> Danh sách sản phẩm</a></li>

       </ul>
     </li>
     <li class="nav-item"><a class="nav-link" href="donhang/list.php">
         <svg class="nav-icon">
           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use> -->
         </svg> ĐƠN HÀNG</a></li>

     <li class="nav-group"><a class="nav-link nav-group-toggle">
         <svg class="nav-icon">
           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use> -->
         </svg> KHUYẾN MÃI</a>
       <ul class="nav-group-items">
         <li class="nav-item"><a class="nav-link" href="promotion/add.php"> Thêm khuyến mãi</a></li>
         <li class="nav-item"><a class="nav-link" href="promotion/list.php"> Danh sách chương trình khuyến mãi</a></li>

       </ul>
     </li>
     <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
         <svg class="nav-icon">
           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use> -->
         </svg> HÌNH ẢNH</a>
       <ul class="nav-group-items">
         <li class="nav-item"><a class="nav-link" href="banner/showbanner.php"> Banner</a></li>

       </ul>
     </li>
     <li class="nav-item"><a class="nav-link" href="comment/list.php">
         <svg class="nav-icon">
           <!-- <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use> -->
         </svg> BÌNH LUẬN</a></li>

     <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
 </div>
 <div class="wrapper d-flex flex-column min-vh-100 bg-light">
   <header class="header header-sticky mb-4">
     <div class="container-fluid">
       <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
         <svg class="icon icon-lg">
           <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
         </svg>
       </button><a class="header-brand d-md-none" href="#">
         <svg width="118" height="46" alt="CoreUI Logo">
           <use xlink:href="assets/brand/coreui.svg#full"></use>
         </svg></a>
       <!-- <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
          </ul> -->
       <ul class="header-nav ms-auto">
         <li class="nav-item"><a class="nav-link" href="#">
             <svg class="icon icon-lg">
               <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
             </svg><?php echo $fullname ?></a>

         </li>

         <li class="nav-item"><a class="nav-link" href="user/logout.php">
             <svg class="icon icon-lg">
               <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
             </svg> Đăng xuất</a></li>
         <!-- <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg></a></li> -->
       </ul>
       <!-- <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Account</div>
                </div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                  </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                  </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                  </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                  </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                <div class="dropdown-header bg-light py-2">
                  <div class="fw-semibold">Settings</div>
                </div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                  </svg> Profile</a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                  </svg> Settings</a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                  </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                  </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                  </svg> Lock Account</a><a class="dropdown-item" href="#">
                  <svg class="icon me-2">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg> Logout</a>
              </div>
            </li>
          </ul> -->
     </div>