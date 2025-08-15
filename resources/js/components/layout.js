export default () => ({
    sidebarOpen: false,
    userMenuOpen: false,
    darkMode: false,

    init() {
        const saved = localStorage.getItem('theme');
        this.darkMode = saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches);
        document.documentElement.classList.toggle('dark', this.darkMode);
        window.addEventListener('resize', () => this.onResize());
    },

    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
    },

    toggleUserMenu() {
        this.userMenuOpen = !this.userMenuOpen;
    },

    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        document.documentElement.classList.toggle('dark', this.darkMode);
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    },

    onResize() {
        if (window.innerWidth >= 1024) {
            this.sidebarOpen = false;
        }
    }
});
