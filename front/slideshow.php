<?php
require '../libraries/connect.php';

$sql_banner = "SELECT *from banner where id_banner<>1";
$result_banner = mysqli_query($conn, $sql_banner);

$sql = "SELECT *from banner where id_banner=1";
$result = mysqli_query($conn, $sql);
$banner_first = mysqli_fetch_assoc($result);


?>

<style>
  .slide img {
    width: 100%;
    height: 75%;
  }
</style>

<div class="Slide_chay">
  <div class="slider">
    <div class="slides">
      <input type="radio" name="radio-btn" id="radio1">
      <input type="radio" name="radio-btn" id="radio2">
      <input type="radio" name="radio-btn" id="radio3">
      <input type="radio" name="radio-btn" id="radio4">
      <input type="radio" name="radio-btn" id="radio5">
      <div class="slide first">
        <img src="<?php echo '../admin/upload/' . $banner_first['image']; ?>" alt="">
      </div>
      <?php
      if (mysqli_num_rows($result_banner) > 0) {
        while ($banner = mysqli_fetch_assoc($result_banner)) {
          if ($banner['id_banner'] < 5) {
      ?>
            <div class="slide">
              <img src="<?php echo '../admin/upload/' . $banner['image']; ?>" alt="">
            </div>
      <?php
          }
        }
      }
      ?>


    </div>
    <!-- <div class="navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>
                        <div class="auto-btn5"></div>
                      </div> -->

  </div>

  <!-- <div class="navigation-manual">
                      <label for="radio1" class="manual-btn"></label>
                      <label for="radio2" class="manual-btn"></label>
                      <label for="radio3" class="manual-btn"></label>
                      <label for="radio4" class="manual-btn"></label>
                      <label for="radio5" class="manual-btn"></label>
                    </div> -->

</div>
<script type="text/javascript">
  var counter = 1;
  setInterval(function() {
    document.getElementById('radio' + counter).checked = true;
    counter++;
    if (counter > 5) {
      counter = 1;
    }
  }, 3000);
</script>
</div>

<style>
  /* SLIDESHOW */
  .Slide_chay {
    margin: 0;
    padding: 0;

    display: flex;
    justify-content: center;
    align-items: center;
  }

  .slider {
    width: 100%;
    height: 566px;
    overflow: hidden;

  }

  .slides {
    width: 500%;
    height: 500px;
    display: flex;
  }

  .slides input {
    display: none;
  }

  .slide {
    width: 20%;
    transition: 2s;
  }

  .slide img {
    width: 100%;
    height: 50%;
  }

  .navigation-manual {
    position: absolute;
    width: 100%;
    margin-top: 0px;
    display: flex;
    justify-content: center;

  }

  .manual-btn {
    border: 2px solid #d6eb5f;
    padding: 5px;
    border-radius: 10px;
    cursor: pointer;
    transition: 1s;
  }

  .manual-btn:not(:last-child) {
    margin-right: 40px;
  }

  .manual-btn:hover {
    background: #d6eb5f;
  }

  #radio1:checked~.first {
    margin-left: 0;
  }

  #radio2:checked~.first {
    margin-left: -20%;
  }

  #radio3:checked~.first {
    margin-left: -40%;
  }

  #radio4:checked~.first {
    margin-left: -60%;
  }

  .navigation-auto {
    position: absolute;
    display: flex;
    width: 100%;
    justify-content: center;
    margin-top: 500px;
  }

  .navigation-auto div {
    border: 2px solid #d6eb5f;
    padding: 5px;
    border-radius: 10px;
    transition: 1s;
  }

  .navigation-auto div:not(:last-child) {
    margin-right: 40px;
  }

  #radio1:checked~.navigation-auto .auto-btn1 {
    background: #d6eb5f;
  }

  #radio2:checked~.navigation-auto .auto-btn2 {
    background: #d6eb5f;
  }

  #radio3:checked~.navigation-auto .auto-btn3 {
    background: #d6eb5f;
  }

  #radio4:checked~.navigation-auto .auto-btn4 {
    background: #d6eb5f;
  }
</style>

<style>
  .slide img {
    width: 100%;
    height: 75%;
  }
</style>