<!-- HEADER -->
<?php
$pageName = "Manage Articles";
require_once "./includes/header.php";
?>
<body>
  <main>
    <section class="block px-20 xs:px-4 sm:px-6 md:px-8 lg:px-16 py-12 min-w-full" >
      <a href="create.php" class="block text-sm text-gray-200 font-bold bg-blue-400 rounded-md px-4 py-2 my-8 w-28">
        <i class="fas fa-plus"></i>
        <span>Add New</span>
      </a>
      <div class="text-base xs:text-sm text-gray-600 font-medium bg-blue-200 rounded-md shadow-md shadow-gray-400 px-8 xs:px-4 py-6 xs:py-4">
        <table class="min-w-full">
          <thead class="text-base text-gray-200 font-bold bg-gray-800">
            <tr>
              <th scope="col" class="px-4 py-3" >SL</th>
              <th scope="col" class="px-4 py-3" >Title of Article</th>
              <th scope="col" class="px-4 py-3" >Slug</th>
              <th scope="col" class="px-4 py-3" >Status</th>
              <th scope="col" class="px-4 py-3" >Published at</th>
              <th scope="col" class="px-4 py-3" >Action</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr class="border-b-2 border-gray-500 bg-gray-100 hover:bg-gray-200">
              <td class="px-4 py-3" >SL</td>
              <td class="px-4 py-3" >Title of Article</td>
              <td class="px-4 py-3" >Slug</td>
              <td class="px-4 py-3" >Status</td>
              <td class="px-4 py-3" >Published at</td>
              <td class="px-4 py-3" >
                <form action="" method="post" >
                  <a href="#" class="inline-block text-blue-500 hover:text-gray-200 hover:bg-blue-500 border-2 border-blue-500 rounded-md p-1 w-8 h-8">
                    <i class="fas fa-edit"></i>
                  </a>
                  <button type="submit" class="inline-block text-red-500 hover:text-gray-200 hover:bg-red-500 border-2 border-red-500 rounded-md p-1 w-8 h-8">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <!-- FOOTER -->
  <?php require_once "./includes/footer.php"; ?>
</body>
</html>