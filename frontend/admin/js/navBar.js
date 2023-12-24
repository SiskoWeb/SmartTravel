document.addEventListener('DOMContentLoaded', () => {
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
})