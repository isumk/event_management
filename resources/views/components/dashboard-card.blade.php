@props(['title', 'count', 'link'])

<a href="{{ $link }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
    <div class="text-5xl font-bold text-blue-600 dark:text-blue-400">{{ $count }}</div>
    <div class="mt-2 text-gray-600 dark:text-gray-300 uppercase tracking-wide font-semibold">{{ $title }}</div>
</a>
<style>
    .dashboard-card {
        @apply block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105;
    }
    .dashboard-card .count {
        @apply text-5xl font-bold text-blue-600 dark:text-blue-400;
    }
    .dashboard-card .title {
        @apply mt-2 text-gray-600 dark:text-gray-300 uppercase tracking-wide font-semibold;
    }
    .dashboard-card:hover {
        @apply shadow-2xl transform scale-105;
    }
    .dashboard-card:hover .count {
        @apply text-blue-700 dark:text-blue-500;
    }
    .dashboard-card:hover .title {
        @apply text-gray-700 dark:text-gray-200;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.dashboard-card');
        cards.forEach(card => {
            card.addEventListener('mouseover', function () {
                this.classList.add('hover:shadow-2xl', 'hover:scale-105');
            });
            card.addEventListener('mouseout', function () {
                this.classList.remove('hover:shadow-2xl', 'hover:scale-105');
            });
        });
    });
</script>
