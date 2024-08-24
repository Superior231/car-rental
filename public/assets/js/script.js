// Sidebar
try {
    const body         = document.querySelector("body"),
          sidebar      = body.querySelector(".sidebar"),
          toggle       = body.querySelector(".toggle"),
          rowDashboard = body.querySelector("#row-dashboard");

    // Menyimpan status sidebar di localStorage
    const sidebarState = localStorage.getItem("sidebar");

    if (sidebarState === "open") {
        sidebar.classList.remove("close");
        if (rowDashboard) {
            rowDashboard.classList.remove('row-cols-lg-4');
            rowDashboard.classList.add('row-cols-lg-2');
        }
    } else {
        sidebar.classList.add("close");
        if (rowDashboard) {
            rowDashboard.classList.remove('row-cols-lg-2');
            rowDashboard.classList.add('row-cols-lg-4');
        }
    }

    // Sidebar toggle
    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");

        // Update kolom berdasarkan status sidebar
        if (sidebar.classList.contains("close")) {
            if (rowDashboard) {
                rowDashboard.classList.remove('row-cols-lg-2');
                rowDashboard.classList.add('row-cols-lg-4');
            }
            localStorage.setItem("sidebar", "closed");
        } else {
            if (rowDashboard) {
                rowDashboard.classList.remove('row-cols-lg-4');
                rowDashboard.classList.add('row-cols-lg-2');
            }
            localStorage.setItem("sidebar", "open");
        }
    });
} catch (error) {
    console.log("Sidebar tidak ditemukan!");
}
// Sidebar End


// Navbar
try {
    const navbar = document.querySelector(".navbar");
    const classList = ["shadow-sm", "border-bottom", "border-secondary", "bg-light"];

    if (navbar) {
        const handleScroll = () => {
            const action = window.pageYOffset > 0.1 ? 'add' : 'remove';
            if (navbar) navbar.classList[action](...classList);
        };

        window.addEventListener("scroll", handleScroll);
    }
} catch (error) {
    console.log("Fitur navbar tidak ditemukan!");
}
// Navbar End
