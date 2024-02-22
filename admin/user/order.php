<!DOCTYPE html><!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2023 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
--><!-- Breadcrumb-->
<html lang="en">
  <head>
    <base href="./../">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>QUẢN TRỊ DANH SÁCH NGƯỜI DÙNG</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="css/vendors/simplebar.css">

    <script src="../js/delete.js"></script>
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="css/examples.css" rel="stylesheet">
    <link rel="canonical" href="https://coreui.io/docs/components/breadcrumb/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      div#sidebar {
          background-color: #FF99CC;
        }

      input#button {
          background: #FF99CC;
          border-radius: 8px;
          border-color: #FF99CC;
      }
      tr.title {
          background: #FF99CC;
          text-align: center
      }
      table.list.table.table-striped {
          font-size: 12px;
      }
      td {
          text-align: center;
      }

      b#cochu {
    font-weight: bolder;
    font-size: 21px;
}
      </style>
  </head>
  <body>
  <?php require '../header.php';?>
        <div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a href="#">MEVABE</a>
              </li>
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><a href="#">KHUYẾN MÃI</a>
              </li>
              <li class="breadcrumb-item active"><span>Danh sách chương trình khuyến mãi</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header"><strong>DANH SÁCH CHƯƠNG TRÌNH KHUYẾN MÃI</strong></div>
                <div class="card-body">
                  
                  <div class="example">

                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
    
                          <input type="button" name="all" value="Tất cả" id="button">
                          <input type="button" name="dangkhuyenmai" value="Đang khuyến mãi" id="button">
                          <input type="button" name="dung" value="Đã khuyến mãi" id="button">
                        <table cellpadding="10"  border="1" class="list table table-striped table-bordered" style="font-style:15px;">

                                  <tr class="title">
                                      <th>ID</th>
                                      <th>Tên khuyến mãi</th>
                                      <th>Ngày bắt đầu</th>
                                      <th>Ngày kết thúc</th>
                                      <th>Nội dung</th>
                                      <th>Giá giảm</th>
                                      <th>Giá gốc</th>
                                      <th>Trạng thái</th>
                                      <th>Ngày tạo</th>
                                      <th>Sản phẩm áp dụng</th>
                                      <th>Tác vụ</th>
                                  </tr>    
                                  <?php 
                                      while ($promotion =mysqli_fetch_assoc($promotion_list)):
                                  ?>
                                      <tr>
                                          <td>
                                              <?php echo $promotion['id-promotion'];?>
                                          </td>
                                          <td>
                                              <?php echo $promotion['name'];?>
                                          </td>
                                          <td>
                                              <?php echo date('d/m/Y', strtotime($promotion['start_day'])) ;?>
                                          </td>
                                          <td>
                                              <?php echo date('d/m/Y', strtotime($promotion['end_day'])) ;?>
                                          </td>
                                          <td>
                                              <?php echo $promotion['content'];?>
                                          </td>
                                          <td>
                                              <?php echo number_format($promotion['discount'], 0, '', '.'); ?> VNĐ</td>
                                          </td>
                                          <td>
                                              <?php echo number_format($promotion['price'], 0, '', '.'); ?> VNĐ</td>
                                          </td>

                                          <td>
                                              <?php echo ($promotion['status']==1)?'Đang khuyến mãi':'Đã khuyến mãi';?>
                                          </td>
                                          <td>
                                            <?php echo date('d/m/Y H:i:s', strtotime($promotion['created'])) ;?>                                            
                                          </td>
                                          <td>
                                              <?php echo $promotion['name_pro'];?>
                                          </td>
                                          
                                          <td>
                                          <!-- <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $user['iduser'];?>, '<?php echo $fullname=$_GET['fullname'];?>')"><span class="material-symbols-outlined">delete</span></a>
                                          <a href="user/edit.php?iduser=<?php echo $user['iduser'];?>&fullname=<?php echo $fullname=$_GET['fullname'];?>"><span class="material-symbols-outlined">border_color</span></a> -->
                                          </td>

                                      </tr>
                                  <?php endwhile;?>
                              </table>
                              
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
      <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
      </footer>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="vendors/simplebar/js/simplebar.min.js"></script>
    <script>
    </script>
<script>
// function confirmDelete(iduser, fullname) {
//     Swal.fire({
//         title: 'Confirmation',
//         text: 'Bạn có chắc muốn xóa '?',,
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Xóa',
//         cancelButtonText: 'Hủy'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location.href = 'user/delete.php?iduser=' + iduser +'&fullname=' + fullname;
//         }
//     });
// }

</script>

  </body>
</html>