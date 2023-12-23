<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/ea3542be0c.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="relative grid min-h-screen w-full lg:grid-cols-[280px_1fr]">
        <?php include('components/sidebar.php') ?>
        <div class="flex flex-col">
            <header class="flex h-14 lg:h-[60px] items-center gap-4 border-b bg-gray-100/40 px-6 dark:bg-gray-800/40">
                <button id="sidebar_admin_btn" class="lg:hidden"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"></path>
                        <path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"></path>
                        <path d="M12 3v6"></path>
                    </svg><span class="sr-only">Home</span></button>
            </header>
            <main class="flex-1 p-4 ">


                <?php include('components/bus/FormCreate.php') ?>



                <?php include('components/bus/table.php') ?>
            </main>

        </div>
    </div>



    <script>
        const sidebar_admin_btn = document.getElementById('sidebar_admin_btn')

        sidebar_admin_btn.addEventListener('click', () => {
            const sidebar_admin = document.getElementById('sidebar_admin')
            console.log('clicked')
            if (sidebar_admin.classList.contains('hidden')) {
                sidebar_admin.classList.remove('hidden')

            } else {
                sidebar_admin.classList.add('hidden')
            }

        })

        const sidebar_admin_btn2 = document.getElementById('sidebar_admin_btn2')

        sidebar_admin_btn2.addEventListener('click', () => {
            const sidebar_admin = document.getElementById('sidebar_admin')
            console.log('clicked')
            if (sidebar_admin.classList.contains('hidden')) {
                sidebar_admin.classList.remove('hidden')

            } else {
                sidebar_admin.classList.add('hidden')
            }

        })
    </script>
</body>

</html>