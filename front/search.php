  <!-- Hero Section Begin -->
  <section class="hero hero-normal ab">
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
                  <div class="hero__categories">
                      <div class="hero__categories__all " id="hero">
                          <i class="fa fa-bars"></i>
                          <span id="dm">Danh mục</span>
                      </div>
                      <ul>
                          <?php
                            $sql_danhmuc = "SELECT * from category where status=1 order by name";
                            $result_danhmuc = mysqli_query($conn, $sql_danhmuc);

                            while ($row = mysqli_fetch_assoc($result_danhmuc)) {
                            ?>
                              <li class="dropdown">
                                  <a id="ten" href="shop-category.php?category_id=<?php echo $row['category_id'] ?>"><?php echo $row['name']; ?></a>
                                  <?php
                                    // if ($row['name'] == "Sữa bột") {

                                    //     echo '<ul class="dropdown-menu hidden">
                                    //             <li class="dmcon"><a>Theo tuổi</a></li>

                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=0-1 tuổi">0-1 tuổi</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=1-2 tuổi">1-2 tuổi</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=trên 2 tuổi">trên 2 tuổi</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=mẹ">Sữa bầu</a></li>
                                    //         </ul>';
                                    // }
                                    // if ($row['name'] == "Bỉm, tã") {

                                    //     echo '<ul class="dropdown-menu hidden">
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php">Theo loại bỉm/tã</a></li>
                                    //             <hr>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=tã quần">Tã quần</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=tã dán">Tã dán</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=mieng">Miếng lót</a></li>
                                    //         </ul>';
                                    // }
                                    // if ($row['name'] == "Thời trang và phụ kiện") {

                                    //     echo '<ul class="dropdown-menu hidden">                                              
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=thời trang bé trai">Bé trai</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=thời trang bé gái">Bé gái</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php??danhmuccon=thời trang sơ sinh">Sơ sinh</a></li>
                                    //             <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=thời trang mẹ bầu">Mẹ bầu</a></li>
                                    //         </ul>';
                                    // }
                                    ?>

                              </li>
                          <?php
                            }
                            ?>
                      </ul>


                  </div>
              </div>
              <div class="col-lg-9">
                  <div class="hero__search">
                      <div class="hero__search__form small-search">
                          <form action="#" id="a" method="POST">
                              <!-- <div class="hero__search__categories">
                                    Tất cả sản phẩm
                                    <span class="arrow_carrot-down"></span>
                                </div> -->
                              <input type="text" name="search" placeholder="Bạn cần tìm gì?" id="search" require>
                              <button type="submit" class="site-btn" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Tìm kiếm</button>
                          </form>
                      </div>
                      <div class="hero__search__phone">
                          <div class="hero__search__phone__icon">
                              <i class="fa fa-phone"></i>
                          </div>
                          <div class="hero__search__phone__text">
                              <h5><a href="tel:+84824106576">0706386195</a></h5>
                              <span>Hỗ trợ 24/7</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <script>
      $(document).ready(function() {
          // Ẩn tất cả danh mục con ban đầu
          $(".dropdown-menu").hide();

          // Hiển thị danh mục con khi di chuột qua
          $(".dropdown").hover(
              function() {
                  $(this).find(".dropdown-menu").show();
              },
              function() {
                  $(this).find(".dropdown-menu").hide();
              }
          );
      });
  </script>

  <style>
      .section.hero.hero-normal.ab {
          padding-bottom: 66px;
      }

      .dropdown-menu {
          display: none;
      }

      .hero.hero-normal .hero__categories ul {
          display: none;
          position: absolute;
          left: 0;
          top: 33px;
          width: 100%;
          z-index: 9;
          background: #ffffff;
      }

      .dropdown:hover .dropdown-menu {
          display: block;
          /* color: #cc3069; */
      }

      .hero__search__form {
          width: 610px;
          height: 33px;
          border: 1px solid #ebebeb;
          position: relative;
          float: left;
      }

      .hero__categories ul li a:hover {
          font-size: 16px;
          color: #E91E63;
          line-height: 39px;
          display: block;
      }

      .hero__search__form form input {
          width: 70%;
          border: none;
          height: 32px;
          font-size: 14px;
          color: #b2b2b2;
          padding-left: 20px;
      }

      .hero__search__form form button {
          position: absolute;
          right: 0;
          top: -1px;
          height: 33px;
      }

      .site-btn {
          font-size: 13px;
          color: #ffffff;
          font-weight: 800;
          /* text-transform: uppercase; */
          display: inline-block;
          padding: 8px 10px;
          background: #CC3069;
          border: none;
      }

      .col-lg-3.col-md-4.col-sm-6.mix {
          -ms-flex: 0 0 25%;
          flex: 0 0 25%;
          max-width: 24%;
          border-style: ridge;
          border-color: #cc3069;
          padding: 103xp;
          margin: 1px 2px;
      }

      #hero {
          background: #CC3069;
          position: relative;
          padding: 4px 50px;
          cursor: pointer;
          height: 34px;
      }

      #hero:after {
          position: absolute;
          right: 18px;
          top: 5px;
          content: "3";
          font-family: "ElegantIcons";
          font-size: 18px;
          color: #ffffff;
          padding: -18px 12px;
      }

      .hero__search__form form input {
          width: 70%;
          border: none;
          height: 30px;
          font-size: 14px;
          color: #b2b2b2;
          padding-left: 20px;
      }

      .featured__item__text h6 a:hover {
          color: #E91E63;
      }

      /* DANH MỤC CON */
      ul.dropdown-menu {
          margin-left: 220px;
          margin-top: -50px
      }
  </style>