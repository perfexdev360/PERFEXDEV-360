document.addEventListener('alpine:init', () => {
    Alpine.data('page', () => ({
        init() {
            this.$el.classList.add('opacity-0');
            requestAnimationFrame(() => {
                this.$el.classList.remove('opacity-0');
            });
            window.addEventListener('beforeunload', () => {
                this.$el.classList.add('opacity-0');
            });
        },
    }));
});
