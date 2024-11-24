document.addEventListener('DOMContentLoaded', () => {
    const role = localStorage.getItem('role') || 'guest'; // Lấy role từ localStorage, mặc định là 'guest'
    const currentPage = window.location.pathname; // Đường dẫn hiện tại

    // Xử lý quyền truy cập dựa trên vai trò
    if (role === 'admin') {
        console.log('Welcome, admin!');
        // Admin được phép truy cập tất cả các trang
    } else if (role === 'user') {
        console.log('Welcome, user!');
        if (currentPage.includes('admin')) {
            // Nếu user cố truy cập trang admin, chuyển hướng về trang user
            alert('You do not have access to this page!');
            window.location.href = '/user/home.html'; // Trang user
        }
    } else {
        console.log('Guest detected!');
        if (currentPage.includes('admin') || currentPage.includes('user')) {
            // Guest không có quyền vào các trang admin hoặc user
            alert('Please log in to access this page.');
            window.location.href = '/auth/login.html'; // Trang login
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const role = localStorage.getItem('role') || 'guest'; // Lấy vai trò từ localStorage
    const currentPage = window.location.pathname;

    if (role === 'admin') {
        // Admin được phép truy cập tất cả
        console.log('Welcome, Admin!');
    } else if (role === 'user') {
        if (currentPage.includes('/admin/')) {
            alert('You do not have permission to access admin pages!');
            window.location.href = '/user/home.html'; // Trang user
        }
    } else {
        if (currentPage.includes('/admin/') || currentPage.includes('/user/')) {
            alert('Please log in to access this page!');
            window.location.href = '/auth/login.html'; // Trang đăng nhập
        }
    }
});



