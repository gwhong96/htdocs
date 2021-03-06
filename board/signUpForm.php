<!-- 회원가입 & 회원정보 수정 폼 -->
<!doctype html>
<html>
<head><title></title></head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<script src="./js/init-alpine.js"></script>
<link rel="stylesheet" href="./css/tailwind.output.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<!-- <script>
$(function(){ //jquery  달력 UI위젯 datepicker
      $("#birthUI").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
  });
</script> -->

<body>
  <div style="padding-left:250px">
    <h3><a href="./list.php"><img src="../img/logo.svg"/></a></h3>


  <?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/connectDB.php';

  if(isset($_SESSION['memberID'])){//회원정보 수정일 때
    $memberID = $_SESSION['memberID'];
    $sql = "SELECT memberID, nickName, memberPW, email, birthDay FROM member WHERE memberID = {$memberID}";
    $result = $dbConnect -> query($sql);
    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
    echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>회원정보 수정</h4></div>";
  }else{//회원가입일 때
    echo "<h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>회원가입</h4></div>";
  }
   ?>

  <div class="flex items-center p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
          <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="../img/create-account-office.jpeg"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../assets/img/create-account-office-dark.jpeg"
              alt="Office"
            />
        </div>

        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
          <div class="w-full">
            <form name = "signUp" method = "post" action="./signUp.php">
              <?php
              if(isset($_SESSION['memberID'])){
              ?>
              <h1 style="color:gray" class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">회원정보 수정</h1>
            <?php }else{?>
              <h1 style="color:gray" class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">회원 가입</h1>
            <?php } ?>
            <br>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">E-mail</span>
                <input style = "background-color : lightgray" type = "email" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name = "userEmail" value = "<?= (isset($memberInfo['email']) ? $memberInfo['email'] : '') ?>" required>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nick-name</span>
                <input style = "background-color : lightgray" type = "text" autocomplete="off" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name = "userNickName" value = "<?= (isset($memberInfo['nickName']) ? $memberInfo['nickName'] : '') ?>" required>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input style="background:lightgray" type = "password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name = "userPW" required>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Password_Check</span>
                <input style="background:lightgray" type = "password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name = "userPW_check" required>
              </label>


              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Gender</span><br><br>
                <input type = "radio" name = "gender" value="m" checked>남
                <input type = "radio" name = "gender" value="w">여
              </label>
              <br>
              <label>
                <span class="text-gray-700 dark:text-gray-400">Birth-Date : </span>
                <?php
                  if(isset($memberInfo['memberID'])){
                ?>
                  <input type = "date"  value = "<?=$memberInfo['birthDay']?>" name = "birth">
                  <br><br>
                  <button type="submit" style="background:gray" class="w-full items-center px-4 py-2 text-sm font-medium text-white rounded-lg">
                    수정정보 저장</button>
                <?php
                }else{
                 ?>
                <input type = "date" name = "birth">
                <br><br>
                <button type="submit" style="background:gray" class="w-full items-center px-4 py-2 text-sm font-medium text-white rounded-lg">
                  회원가입</button>
                <?php
              }
              ?>
              </label>
            </form>
        </div>
      </div>
    </div>
    </div>
    </div>
</body>
</html>
