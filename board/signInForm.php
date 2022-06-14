<!-- 로그인 폼 -->
<!doctype html>
<html>
<head></head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<script src="./js/init-alpine.js"></script>
<link rel="stylesheet" href="./css/tailwind.output.css" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>


<h3><a href="./list.php"><img src="../img/logo.svg"/></a></h3><br>
<body>

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
              <form name = "signIn" method = "post" action = "./signIn.php"><!--입력값 전송 대상 URL-->
                <h1 style="color:gray" class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">로그인</h1>
                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">E-mail</span>
                  <input type = "email" name = "userEmail" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                </label>

                <label class="block text-sm">
                  <span class="text-gray-700 dark:text-gray-400">Password</span>
                  <input type = "password" name = "userPW" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required/>
                  <br>
                </label>

                  <button type="submit" style="background:gray" class="w-full items-center px-4 py-2 text-sm font-medium text-white rounded-lg">
                    로그인</button>

              </form>
            </div>
          </div>
</body>
</html>
