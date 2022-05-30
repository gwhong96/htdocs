<!-- 초기화면 -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'./board/session.php';
  include $_SERVER['DOCUMENT_ROOT'].'./board/passwordCheck.php';
?>

<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="./css/tailwind.output.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="./js/init-alpine.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
</head>
<h3><a href="./list.php"><img src="../img/logo.svg"/></a></h3><br>
<body>

  <?php if(!isset($_SESSION['memberID'])){//로그인 세션이 없으면 ?>
    <h4 class='mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300'>로그인</h4>
    <div class="flex items-center  p-6 bg-gray-50 dark:bg-gray-900">
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
                <form name = "signIn" method = "post" action = "./signIn.php"><!--입력값 전송 대상 URL-->
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">E-mail</span>
                    <input type = "email" name = "userEmail" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                  </label>

                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Password</span>
                    <input type = "password" name = "userPW" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                    <br>
                  </label>

                  <button class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    <input type = "submit" value = "로그인"/>
                    <svg
                    class="w-4 h-4 mr-2"
                    aria-hidden="true"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    ></svg>
                  </button></br>
                </form>
                <button style="background-color : skyblue" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150" onclick="location.href='./signUpForm.php';">회원가입</button>
                <!-- <a href = "./board/signUpForm.php";>회원가입</a> -->
              </div>
            </div>

  <!-- <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./signUpForm.php';">회원가입</button><br>
  <button type="button" class="items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./signInForm.php';">로그인</button><br> -->
   <?php } else {//로그인 되어있으면 ?>

     <meta http-equiv="refresh" content="0;url=./list.php">

    <!-- <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./list.php';">게시판</button><br>
    <br>
    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./signUpForm.php';">회원정보 수정</button><br>
    <br>
    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" onclick="location.href='./signOut.php';">로그아웃</button><br> -->
    <?php
    }
   ?>
</body>
</html>
