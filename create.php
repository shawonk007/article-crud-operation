<!-- HEADER -->
<?php

use Article\Article;
session_start();
$pageName = "New Article";
require_once "./includes/header.php";
require_once "./class/Article.php";
$articles = new Article($connection);
$errors = [];
// Function to log errors to a file
function logError($errorMessage) {
  $logFile = 'errors_log';
  $logMessage = '[' . date('Y-m-d H:i:s') . ']' . ' | ERROR from New Article | ' . $errorMessage . PHP_EOL;
  error_log($logMessage, 3, $logFile);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $image = isset($_FILES['image'])?$_FILES['image']:null;
  $imgNname = null;
  if($image){
    $imgName = "IMG" . time() . "_sk".".jpg";
    move_uploaded_file($image['tmp_name'],"uploads/".$imgName);
  }
  $slug = $_POST['slug'];
  $tags = $_POST['tags'];
  $status = $_POST['status'];
  if (empty($title)) {
    $errors[] = "Article title is required.";
  }
  if (empty($desc)) {
    $errors[] = "Article description is required.";
  }
  if (empty($slug)) {
    $errors[] = "Article slug is required.";
  }
  if (empty($tags)) {
    $errors[] = "Article tags is required.";
  }
  if (empty($errors)) {
    try {
      if ($articles->create($title, $desc, $image, $slug, $tags, $status)) {
        echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Article Created',
            text: 'Article created successfully.',
            timer: 2000,
            showConfirmButton: false
          }).then(function() {
            window.location.href = 'create.php';
          });
        </script>";
        exit();
      } else {
        echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to create article.',
            timer: 2000,
            showConfirmButton: false
          });
        </script>";
      }
    } catch (\Throwable $e) {
      $errorMessage = $e->getMessage();
      logError($errorMessage);
      echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'An error occurred while creating new article. Please try again later.',
          timer: 2000,
          showConfirmButton: false
        });
      </script>";
    }
  } else {
    $errorString = implode("\\n, $errors");
    logError($errorString);
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: '$errorString',
        timer: 2000,
        showConfirmButton: false
      });
    </script>";
  }
}
?>
<body>
  <main>
    <section class="block px-20 xs:px-4 sm:px-6 md:px-8 lg:px-16 py-12 min-w-full" >
      <div class="flex flex-col items-center justify-center gap-8">
        <h3 class="text-3xl text-gray-600 font-bold">Create New Article</h3>
        <div class="bg-blue-200 rounded-md shadow-md shadow-gray-400 px-8 xs:px-4 py-6 xs:py-4 w-[600px]">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="my-4">
              <label for="title">
                <span>Title</span>
              </label>
              <div class="mt-2">
                <input type="text" name="title" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="title" placeholder="" required />
              </div>
            </div>
            <div class="my-4">
              <label for="description">
                <span>Description</span>
              </label>
              <div class="mt-2">
                <textarea name="description" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full resize-none" id="description" cols="30" rows="10" required ></textarea>
              </div>
            </div>
            <div class="my-4">
              <label for="slug">
                <span>Slug</span>
              </label>
              <div class="mt-2">
                <input type="text" name="slug" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="slug" placeholder="" required />
              </div>
            </div>
            <div class="my-4">
              <label for="tags">
                <span>Tags</span>
              </label>
              <div class="mt-2">
                <input type="text" name="tags" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="tags" placeholder="" />
              </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
              <div class="my-4">
                <label for="image">
                  <span>Thumbnail</span>
                </label>
                <div class="mt-2">
                  <input type="file" name="image" class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-300 dark:focus:border-primary" id="image" />
                </div>
              </div>
              <div class="my-4">
                <label for="status">
                    <span>Status</span>
                </label>
                <div class="mt-2">
                  <select name="status" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="status" >
                    <option selected>-- Choose One --</option>
                    <option value="1">Display</option>
                    <option value="0">Hidden</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-8 font-bold mt-8">
              <a href="articles.php" class="block text-center text-gray-800 bg-gray-400 hover:bg-gray-500 px-4 py-2 w-full">
                <i class="fas fa-arrow-left"></i>
                <span>Previous</span>
              </a>
              <button type="submit" class="block text-gray-200 bg-blue-500 hover:bg-blue-600 px-4 py-2 w-full" >
                <i class="fas fa-plus"></i>
                <span>Submit</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
  <!-- FOOTER -->
  <?php require_once "./includes/footer.php"; ?>
</body>
</html>