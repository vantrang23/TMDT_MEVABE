                        <ul>
                            <?php
                            $sql_danhmuc = "SELECT * from category order by name";
                            $result_danhmuc = mysqli_query($conn, $sql_danhmuc);

                            while ($row = mysqli_fetch_assoc($result_danhmuc)) {
                            ?>
                                <li class="dropdown">
                                    <a id="ten" href="#"><?php echo $row['name']; ?></a>
                                    <?php
                                    if ($row['name'] == "Sữa bột") {

                                        echo '<ul class="dropdown-menu hidden">
                                                <li class="dmcon"><a>Theo tuổi</a></li>
                                               
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=0-1 tuổi">0-1 tuổi</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=1-2 tuổi">1-2 tuổi</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=trên 2 tuổi">trên 2 tuổi</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=mẹ">Sữa bầu</a></li>
                                            </ul>';
                                    }
                                    if ($row['name'] == "Bỉm, tã") {

                                        echo '<ul class="dropdown-menu hidden">
                                                <li class="dmcon"><a href="shop-danhmuccon.php">Theo loại bỉm/tã</a></li>
                                                <hr>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=tã quần">Tã quần</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=tã dán">Tã dán</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=miếng">Miếng lót</a></li>
                                            </ul>';
                                    }
                                    if ($row['name'] == "Thời trang và phụ kiện") {

                                        echo '<ul class="dropdown-menu hidden">                                              
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=thời trang bé trai">Bé trai</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=thời trang bé gái">Bé gái</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php??danhmuccon=thời trang sơ sinh">Sơ sinh</a></li>
                                                <li class="dmcon"><a href="shop-danhmuccon.php?danhmuccon=thời trang mẹ bầu">Mẹ bầu</a></li>
                                            </ul>';
                                    }
                                    ?>

                                </li>
                            <?php
                            }
                            ?>
                        </ul>